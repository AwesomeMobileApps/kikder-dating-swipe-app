<?php

class Kik extends BaseController
{
    public function __construct()
    {
        /**
         * Load the Kik model,
         * so we can use it later in this class with `modelFunction`
         */
        $this->loadModel('Kik');
    }

    public function index()
    {
        if (Main::loggedIn()) {
            $users = $this->modelFunction('getUsers', array('10'));
            View::create('go', 'Go find some users!', array(
                'page' => 'go',
                'users' => $users
            ));
        } else {
            $recentUsers = $this->modelFunction('getRecentUsers', array('10'));
            $countUsers = $this->modelFunction('countUsers');
            $countSwipes = $this->modelFunction('countSwipes');
            View::create('index', 'Find awesome kik users!', array(
                'recent' => $recentUsers,
                'users' => $countUsers,
                'swipes' => $countSwipes
            ));
        }
    }

    public function createAcc()
    {
        $error = '';
        if (Input::post('createAcc')) {
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' .
                RECAPTCHA_SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
            $response = json_decode($response, true);
            $kikname = Input::post('kik_username');
            $email = Input::post('user_email');
            $password = Input::post('user_pass');
            $gender = (int)Input::post('user_gender');

            $checkEmail = $this->modelFunction('modelGetData', array('*', 'user_email', $email));
            $checkKik = $this->modelFunction('modelGetData', array('*', 'user_name', $kikname));
            $fake = '';

            if (empty($kikname) || empty($email) || empty($password) || empty($_POST['g-recaptcha-response'])) {
                $error = 'Please enter the fields below!';
            } elseif (strlen($password) < 6) {
                $error = 'Password must be atleast 6 characters';
            } elseif (!$response['success'] === true) {
                $error = '01010110101001';
            } elseif (!empty($checkEmail)) {
                $error = 'That Email is taken';
            } elseif (!empty($checkKik) && $checkKik->user_fake == 0) {
                $error = 'Username has been taken';
            } elseif (!empty($checkKik) && $checkKik->user_fake == 1) {
                $fake = 1;
            }

            if (empty($error)) {
                // hash password
                $password = Hash::generate($password);
                if ($fake == 1) {
                    // Update current account
                    $this->modelFunction('updateAccount', array($kikname, $email, $password));
                } else {
                    // Create new account
                    $uid = $this->modelFunction('createAccount', array($kikname, $email, $gender, $password));
                    redirect('signin?msg=success');
                }
            }
        }

        return View::create('register', 'Create an account', array(
            'error' => $error
        ));
    }

    public function forgot()
    {
        $error = '';
        $success = '';
        if (Input::get('id')) {
            $id = Input::get('id');
            $getData = $this->modelFunction('modelGetData', array('*', 'user_uid', $id));
            $rand = substr(md5(microtime()), mt_rand(0, 26), 5);
            if (empty($id)) {
                redirect();
            } elseif (empty($getData)) {
                $error = 'Looks like that link has expired...';
            }

            if (empty($error)) {
                $from = ADMIN_EMAIL;
                $subject = SITE_NAME . ' | New Password';
                $password = Hash::generate($rand);
                $headers = "From: " . $from . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $message = '<div style="width: 100%; background-color: #253036; padding: 20px; margin-bottom: 20px;">';
                $message .= '<a href="' . SITE_URL . '" style="color: #7c8b96;">' . SITE_NAME . '</a>';
                $message .= '</div>';
                $message .= 'Hey' . $getData->user_name . '! We have generated you a password!<br />';
                $message .= '<code>' . $rand . '</code>';
                $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
                $message .= '&copy; ' . SITE_NAME . '</a><br /><br />';
                $message .= '<small>You are receiving this email because you registered to "' . SITE_URL . '" with this email address.</small>';
                $message .= '</div>';
                $this->modelFunction('forgotDone', array($id, $getData->user_email, $password));
                mail($getData->user_email, $subject, $message, $headers);
                $success = 'A new password has been sent!';
            }

            return View::create('forgotDone', 'Your new password', array(
                'error' => $error,
                'success' => $success
            ));
        } else {
            if (Input::post('forgot')) {

                $email = Input::post('user_email');
                $userData = $this->modelFunction('modelGetData', array('*', 'user_email', $email));
                if (empty($email)) {
                    $error = 'Please enter an email.';
                } elseif (empty($userData)) {
                    $error = 'That email was not found.';
                }

                if (empty($error)) {
                    $uid = mt_rand(0, 99) . time();
                    $uid = str_shuffle($uid);
                    $from = ADMIN_EMAIL;
                    $subject = SITE_NAME . ' | Request Password Change';
                    $headers = "From: " . $from . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $message = '<div style="width: 100%; background-color: #253036; padding: 20px; margin-bottom: 20px;">';
                    $message .= '<a href="' . SITE_URL . '" style="color: #7c8b96;">' . SITE_NAME . '</a>';
                    $message .= '</div>';
                    $message .= 'Hey' . $userData->user_name . '! If you forgot your password, please continue with the link below! <br />';
                    $message .= 'Otherwise, please just delete this message.<br /><br />';
                    $message .= '<a href="' . SITE_URL . 'forgot?id=' . $uid . '" class="background-color: #82bc23;color: #FFF;padding: 18px 40px;font-size: 16px;border-radius: 40px;">Click here to get a new password!</a>';
                    $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
                    $message .= '&copy; ' . SITE_NAME . '</a><br /><br />';
                    $message .= '<small>You are receiving this email because you registered to "' . SITE_URL . '" with this email address.</small>';
                    $message .= '</div>';
                    $this->modelFunction('forgotAdd', array($uid, $email));
                    mail($email, $subject, $message, $headers);
                    $success = 'An email has been sent to you!';
                }
            }
        }
        return View::create('forgot', 'Forgot Password', array(
            'error' => $error,
            'success' => $success
        ));
    }

    public function signIn()
    {
        $error = '';
        if (Input::post('signIn')) {
            /*
             * Grab the variables from form
             */
            $user_email = Input::post('user_email');
            $user_password = Input::post('user_password');
            $userData = $this->modelFunction('modelGetData', array('*', 'user_email', $user_email));

            /*
             * Check see if form was filled
             */
            if (empty($user_email) || empty($user_password)) {
                $error = 'Please enter an email and password.';
            } elseif (empty($userData)) {
                $error = 'Sorry, no account was found.';
            } elseif (!Hash::compare($user_password, $userData->user_password)) {
                $error = 'Oh! Looks like you wrote the wrong password.';
            }

            if (empty($error)) {
                /*
                 * No errors! Check if they changed profile picture
                 */
                $picture = User::getAvatar($userData->user_name);
                $this->modelFunction('changePicture', array($userData->user_id, $picture));
                Session::setCookie('loggedIn', true);
                Session::setCookie('userId', $userData->user_id);
                redirect();
            }
        }

        return View::create('signin', 'Sign in', array(
            'error' => $error
        ));
    }

    public function signOut()
    {
        if (Main::loggedIn()) {
            Session::removeCookie('loggedIn');
            Session::removeCookie('userId');
        }

        redirect();
    }

    public function loadUsers()
    {
        $seed = Input::post('seed');
        if ($seed) {
            $users = $this->modelFunction('getUsers', array('1'));
            $this->modelFunction('addSwipe');

            $likeId = Input::post('like_id');
            if ($likeId) {
                $userData = $this->modelFunction('getUser', array(User::userId()));
                $likedUserData = $this->modelFunction('getUser', array($likeId));
                $this->sendUserDetailsToLikedUser($userData, $likedUserData);
            }

            include 'templates/append.php';
        }
    }

    public function notFound()
    {
        header('HTTP/1.1 404 Not Found');

        View::create('notFound', 'Page Not Found');
    }

    private function sendUserDetailsToLikedUser(stdClass $userData, stdClass $likedUser)
    {
        $userPhoto = $userData->user_avatar;

        $from = $userData->user_email;
        $to = $likedUser->user_email;

        $subject = 'Someone wants to meet you';
        $headers = "From: " . ADMIN_EMAIL . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = '<div style="width: 100%; background-color: #253036; padding: 20px; margin-bottom: 20px;">';
        $message .= '<a href="' . SITE_URL . '" style="color: #7c8b96;">' . SITE_NAME . '</a>';
        $message .= '</div>';
        $message .= 'Hey' . $likedUser->user_name . '! ' . $userData->user_name . ' likes your photo and so interested to meet you.<br />';
        $message .= '<a href="mailto:' . $from . '"><img src="' . $userPhoto . '" alt="' . $userData->user_name . '" title="' . $userData->user_name . ' wants to meet you." /></a>';
        $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
        $message .= '&copy; ' . SITE_NAME . '</a><br /><br />';
        $message .= '<small>You are receiving this email because you registered to "' . SITE_URL . '" with this email address.</small>';
        $message .= '</div>';

        mail($to, $subject, $message, $headers);
    }
}
