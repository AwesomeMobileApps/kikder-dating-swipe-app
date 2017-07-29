<?php

class Kik_Model
{
    const MAX_RECENT_USERS = 16;

    /** @var string Table name */
    protected $table = 'users';

    /**
     * @param string $userId
     * @param string $avatar
     */
    public function changePicture($userId, $avatar)
    {
        $binds = [
            ':avatar' => $avatar,
            ':user' => $userId
        ];

        Database::query("UPDATE users SET user_avatar = :avatar WHERE user_id = :user", $binds);
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

    /**
     * @param int $uid
     * @param string $email
     */
    public function forgotAdd($uid, $email)
    {
        $binds = [
            ':uid' => $uid,
            ':email' => $email
        ];

        Database::query('UPDATE users SET user_uid = :uid WHERE user_email = :email', $binds);
    }

    /**
     * @param int $uid
     * @param string $email
     * @param string $password
     */
    public function forgotDone($uid, $email, $password)
    {
        $binds = [
            ':password' => $password,
            ':email' => $email
        ];
        Database::query("UPDATE users SET user_uid = '', user_password = :password WHERE user_email = :email", $binds);
    }

    public function addSwipe()
    {
        $binds = [
            ':user' => User::userId(),
            ':time' => time()
        ];

        Database::query("INSERT INTO swipe (swipe_user, swipe_time) VALUES(:user, :time)", $binds);
    }

    /**
     * @param string $kik
     * @param string $email
     * @param string $pass
     */
    public function updateAccount($kik, $email, $pass)
    {
        $binds = [
            ':kik' => $kik,
            ':password' => $pass,
            ':email' => $email
        ];
        Database::query("UPDATE users SET user_email = :email, user_password = :password, user_fake = 0 WHERE user_name = :kik", $binds);
    }

    /**
     * @param string $kik
     * @param string $email
     * @param int $gender
     * @param string $pass
     */
    public function createAccount($kik, $email, $gender, $pass)
    {
        $binds = [
            ':kik' => $kik,
            ':email' => $email,
            ':gender' => $gender,
            ':password' => $pass
        ];

        Database::query("INSERT INTO users (user_name, user_email, user_gender, user_password) VALUES(:kik, :email, :gender, :password)", $binds);
    }

    /**
     * @param int $num
     *
     * @return stdClass
     */
    public function getUsers($num)
    {
        $seed = str_shuffle(time() + microtime());
        $_SESSION['seed'] = $seed;
        Database::query("SELECT * FROM users WHERE user_avatar <> '' ORDER BY RAND($seed) LIMIT 0, $num");

        return Database::fetchAll();
    }

    /**
     * @param int $userId
     *
     * @return stdClass
     */
    public function getUser($userId)
    {
        return $this->modelGetData('*', 'user_id', (int)$userId);
    }

    /**
     * @param string $select
     * @param string $column
     * @param string $value
     *
     * @return stdClass
     */
    public function modelGetData($select, $column, $value)
    {
        Database::query('SELECT ' . $select . ' FROM ' . $this->table . ' WHERE ' . $column . ' = :value', [':value' => $value]);

        return Database::fetch();
    }

    /**
     * @param int $num
     *
     * @return stdClass
     */
    public function getRecentUsers($num = self::MAX_RECENT_USERS)
    {
        Database::query("SELECT * FROM users WHERE user_avatar <> '' ORDER BY user_id DESC LIMIT 0, $num");

        return Database::fetchAll();
    }
}