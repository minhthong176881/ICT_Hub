<?php
require_once('controllers/base_controller.php');
require_once 'models/post.php';

class PostsController extends BaseController {
    private $post;
    function __construct()
    {
        $this->post = new Post();
        $this->folder = 'posts';
    }

    function post() {
        $this->render('post');
    }

    function savePost() {
        // if (!isset($_POST['title']))
    }

    // function getById() {
    //     if(isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $data = $this->post->getById($id);
    //         $this->render('article', $data);
    //     }
    // }
}