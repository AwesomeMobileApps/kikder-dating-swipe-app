<?php

class Kik_Model {
    protected $table = 'users';

    public function modelGetData($select, $column, $value) {
        Database::query('SELECT ' . $select . ' FROM `'.$this->table.'` WHERE `' . $column . '` = :value', array(
            ':value'    => $value
        ));

        return Database::fetch();
    }

    public function changePicture($user_id, $picture)
    {
        Database::query("UPDATE users SET `user_picture` = :picture WHERE `user_id` = :user", array(
            ':picture'    => $picture,
            ':user'        => $user_id
        ));
    }

    public function countUsers()
    {
        Database::query("SELECT * FROM users");

        $res = Database::fetchAll();
        return count($res);
    }

    public function countSwipes()
    {
        Database::query("SELECT * FROM swipe");

        $res = Database::fetchAll();
        return count($res);
    }

    public function forgotAdd($uid, $email)
    {
        Database::query("UPDATE users SET user_uid = '$uid' WHERE user_email = '$email'");
    }

    public function forgotDone($uid, $email, $password)
    {
        Database::query("UPDATE users SET user_uid = '', user_password = '$password' WHERE user_email = '$email'");
    }

    public function addSwipe()
    {
        $user = User::userId();
        $time = time();
        Database::query("INSERT INTO swipe (swipe_user, swipe_time) VALUES('$user', '$time')");
    }

    public function updateAccount($kik, $email, $pass)
    {
        Database::query("UPDATE users SET user_email = '$email', user_password = '$pass', user_fake = '0' WHERE user_name = '$kik'");
    }

    public function createAccount($kik, $email, $gender, $pass)
    {
        Database::query("INSERT INTO users (user_name, user_email, user_gender, user_password) VALUES('$kik', '$email', '$gender', '$pass')");
    }

    public function getUsers($num)
    {
        $seed = str_shuffle(time()+microtime());
        $_SESSION['seed'] = $seed;
        Database::query("SELECT * FROM users WHERE user_picture <> '' ORDER BY RAND($seed) LIMIT 0,$num");

        return Database::fetchAll();
    }

    public function getUser($userId)
    {
        return $this->modelGetData('*', 'user_id', (int)$userId);
    }

    public function getRecentUsers()
    {
        Database::query("SELECT * FROM users WHERE user_picture <> '' ORDER BY user_id DESC LIMIT 16");

        return Database::fetchAll();
    }
}