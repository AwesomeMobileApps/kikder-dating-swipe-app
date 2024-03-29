<?php

class Blog extends BaseController
{
    public function __construct()
    {
        // Load the blog model, so we can use it in the controller
        $this->loadModel('Blog');
    }

    public function viewPost($slug)
    {
        $data = $this->modelFunction('viewPost', array($slug));

        if (!empty($data)) {
            return View::create('viewPost', 'Viewing Post', array(
                'post_id' => $data->post_id,
                'post_title' => $data->post_title,
                'post_content' => $data->post_content,
                'post_author' => $data->user_firstname . ' ' . $data->user_lastname,
                'post_time' => $data->post_time,
                'post_author_desc' => $data->user_description
            ));
        }
    }

    public function index()
    {
        // Search the Model file for the function
        $posts = $this->modelFunction('listPosts');
        View::create('index', 'Draft Index', array(
            'posts' => $posts
        ));
    }
}
