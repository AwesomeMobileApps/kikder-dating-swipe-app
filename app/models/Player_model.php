<?php

class Player_Model
{
    /** @var string Table name */
    protected $table = 'users';

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
     * @param string $dribbbleId
     * @param string $fullName
     * @param string $avatar
     * @param string $permission
     * @param string $username
     * @param string $code
     */
    public function createPlayer($dribbbleId, $fullName, $avatar, $permission, $username, $code)
    {
        $sqlQuery = "INSERT INTO users (user_token, user_name, can_upload_shot, user_dribbble, user_avatar, user_dribbble_id)
          VALUES (:core, :fullName, :permission, :username, :avatar, :dribbbleId)";

        $binds = [
            ':core' => $code,
            ':fullName' => $fullName,
            ':permission' => $permission,
            ':username' => $username,
            ':avatar' => $avatar,
            ':dribbbleId' => $dribbbleId
        ];

        Database::query($sqlQuery, $binds);
    }
}
