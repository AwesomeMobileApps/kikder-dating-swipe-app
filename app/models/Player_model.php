<?php

class Player_Model
{
    /** @var string Table name */
    protected $table = 'users';

    /**
     * @param $select
     * @param $column
     * @param $value
     *
     * @return stdClass
     */
    public function modelGetData($select, $column, $value)
    {
        Database::query('SELECT ' . $select . ' FROM `' . $this->table . '` WHERE `' . $column . '` = :value', array(
            ':value' => $value
        ));

        return Database::fetch();
    }

    /**
     * @param $dribbbleId
     * @param $fullName
     * @param $picture
     * @param $permission
     * @param $username
     * @param $code
     */
    public function createPlayer($dribbbleId, $fullName, $picture, $permission, $username, $code)
    {
        Database::query("INSERT INTO `users` (user_token,user_name, can_upload_shot, user_dribbble, user_picture, user_dribbble_id) VALUES(
            '$code', '$fullName', $permission', '$username', '$picture','$dribbbleId'
        )");
    }
}