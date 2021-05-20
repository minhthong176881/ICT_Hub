<?php
require_once('controllers/base_controller.php');
require_once 'models/post.php';

class PostsController extends BaseController {
    private $post;
    function __construct()
    {
        $this->post = new Post();
        
    }

    function post() {
        $this->render('post');
    }

    function savePost() {
        if (isset($_POST["btn-submit"])) {
            $title = $_POST["title"];
            $tags = $_POST["tag"];
            $content = $_POST["content"];
            
            // $user_id = $_SESSION["user_id"];
            
            // $sql = "INSERT INTO posts(title, content, user_id, is_public, createdate, updatedate ) VALUES ( '$title', '$content', '$user_id', '$is_public', now(), now())";
            // thực thi câu $sql với biến conn lấy từ file connection.php
            // mysqli_query($conn,$sql);
            echo "Posted successfully!";
        }
    }

    // function getById() {
    //     if(isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $data = $this->post->getById($id);
    //         $this->render('article', $data);
    //     }
    // }
}