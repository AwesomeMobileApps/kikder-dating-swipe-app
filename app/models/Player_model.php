<?php

class Player_Model
{
    protected $table = 'users';

    public function modelGetData($select, $column, $value)
    {
        Database::query('SELECT ' . $select . ' FROM `' . $this->table . '` WHERE `' . $column . '` = :value', array(
            ':value' => $value
        ));

        return Database::fetch();
    }

    public function createPlayer($dribbble_id, $fullname, $picture, $permission, $username, $code)
    {
        Database::query("INSERT INTO `users` (user_token,user_name, can_upload_shot, user_dribbble, user_picture, user_dribbble_id) VALUES(
            '$code', '$fullname', $permission', '$username', '$picture','$dribbble_id'
        )");
    }
}