<?php

class Blog_Model
{
    protected $table = 'posts';

    public function listPosts()
    {
        Database::query("SELECT posts.*, users.* FROM `$this->table`, `users` WHERE posts.post_author = users.user_id  ORDER BY posts.post_id DESC");

        return Database::fetchAll();
    }

    public function modelGetData($select, $column, $value)
    {
        Database::query('SELECT ' . $select . ' FROM `' . $this->table . '` WHERE `' . $column . '` = :value', array(
            ':value' => $value
        ));

        return Database::fetch();
    }


    public function viewPost($post_slug)
    {
        Database::query('SELECT posts.*, users.* FROM `' . $this->table . '`, `users` WHERE posts.post_author = users.user_id AND posts.post_slug = :post_slug', array(
            ':post_slug' => $post_slug
        ));

        return Database::fetch();
    }

    public function addShot($imageUrl, $name, $user_id)
    {
        $time = time();
        Database::query("INSERT INTO `$this->table` (shot_title, shot_user, shot_image, shot_time) VALUES(
            '$name', '$user_id', '$imageUrl', '$time'
        )");
    }

    public function getLastRow()
    {
        Database::query('SELECT * FROM `' . $this->table . '` ORDER BY shot_id DESC LIMIT 1');

        return Database::fetchAll();
    }

    public function initShot($shot_slug, $shot_user, $shot_image, $shot_time)
    {
        Database::query('INSERT INTO `' . $this->table . '` (shot_slug, shot_user, shot_image, shot_time) VALUES(:shot_slug, :shot_user, :shot_image, :shot_time)', array(
            ':shot_slug' => $shot_slug,
            ':shot_user' => $shot_user,
            ':shot_image' => $shot_image,
            'shot_time' => $shot_time,
        ));
    }

    public function finishShot($shot_id, $shot_title, $shot_slug, $shot_tags, $shot_desc)
    {
        Database::query('UPDATE `' . $this->table . '` SET `shot_title` = :shot_title, `shot_slug` = :shot_slug, `shot_desc` = :shot_desc, `shot_tags` = :shot_tags, `shot_show` = 1 WHERE `shot_id` = :shot_id', array(
            ':shot_title' => $shot_title,
            ':shot_slug' => $shot_slug,
            ':shot_tags' => $shot_tags,
            ':shot_desc' => $shot_desc,
            ':shot_id' => $shot_id
        ));
    }
}