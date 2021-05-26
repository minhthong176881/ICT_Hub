<?php
require_once('controllers/base_controller.php');
require_once 'models/post.php';

class PostsController extends BaseController {
    private $post;
    function __construct()
    {
        parent::__construct();
        $this->post = new Post();
    }

    function post() {
        $this->render('post');
    }

    function detail() {
        if (isset($_GET['id'])) {
            $selectedPost = $this->post->getById($_GET['id']);
            $data = array('post' => $selectedPost);
            $this->render('detail', $data);
        } else header('Location: index.php?controller=pages&action=error');
    }
}