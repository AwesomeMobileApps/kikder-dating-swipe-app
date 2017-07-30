<?php

class Blog_Model
{
    /** @var string Table name */
    protected $table = 'posts';

    public function listPosts()
    {
        Database::query('SELECT posts.*, users.* FROM ' . $this->table . ', users WHERE posts.post_author = users.user_id ORDER BY posts.post_id DESC');

        return Database::fetchAll();
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
        Database::query('SELECT ' . $select . ' FROM ' . $this->table . ' WHERE ' . $column . ' = :value', [
            ':value' => $value
        ]);

        return Database::fetch();
    }


    /**
     * @param string $post_slug
     *
     * @return stdClass
     */
    public function viewPost($post_slug)
    {
        Database::query('SELECT posts.*, users.* FROM ' . $this->table . ', users WHERE posts.post_author = users.user_id AND posts.post_slug = :post_slug', [
            ':post_slug' => $post_slug
        ]);

        return Database::fetch();
    }

    /**
     * @param string $imageUrl
     * @param string $name
     * @param int $user_id
     */
    public function addShot($imageUrl, $name, $user_id)
    {
        $sqlQuery = 'INSERT INTO ' . $this->table . ' (shot_title, shot_user, shot_image, shot_time)
            VALUES(:name, :user_id, :image_url, :title)';
        $binds = [
            ':name' => $name,
            ':user_id' => $user_id,
            ':image_url' => $imageUrl,
            ':time' => time()
        ];

        Database::query($sqlQuery, $binds);
    }

    /**
     * @return stdClass
     */
    public function getLastRow()
    {
        Database::query('SELECT * FROM ' . $this->table . ' ORDER BY shot_id DESC LIMIT 1');

        return Database::fetchAll();
    }

    public function initShot($shot_slug, $shot_user, $shot_image, $shot_time)
    {
        $sqlQuery = 'INSERT INTO ' . $this->table . ' (shot_slug, shot_user, shot_image, shot_time)
            VALUES(:shot_slug, :shot_user, :shot_image, :shot_time)';
        $binds = [
            ':shot_slug' => $shot_slug,
            ':shot_user' => $shot_user,
            ':shot_image' => $shot_image,
            ':shot_time' => $shot_time
        ];

        Database::query($sqlQuery, $binds);
    }

    public function finishShot($shot_id, $shot_title, $shot_slug, $shot_tags, $shot_desc)
    {
        $sqlQuery = 'UPDATE ' . $this->table . '
            SET shot_title = :shot_title, shot_slug = :shot_slug, shot_desc = :shot_desc, shot_tags = :shot_tags, shot_show = 1
            WHERE shot_id = :shot_id';
        $binds = [
            ':shot_title' => $shot_title,
            ':shot_slug' => $shot_slug,
            ':shot_tags' => $shot_tags,
            ':shot_desc' => $shot_desc,
            ':shot_id' => $shot_id
        ];

        Database::query($sqlQuery, $binds);
    }
}