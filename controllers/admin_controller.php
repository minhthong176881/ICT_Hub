<?php

use Common\Utility;
use ICT_Hub\models;

require_once 'controllers/base_controller.php';
require_once('models/user.php');
require_once('models/article.php');
require_once('models/subject.php');
require_once('models/post.php');


class AdminController extends BaseController {
    function __construct()
    {
        parent::__construct();
    }

    public function render($file, $data = null) {
        $viewFile = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($viewFile)) {
            if ($data) {
                if (is_array($data))
                    extract($data);
            }
            ob_start();
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/admin/layouts/index.php');
        } else {
            header('Location: index.php?controller=pages&action=error');
        }
    }

    public function index() {
        $users = new User();
        $users = $users->all();
        $userCount = count($users);

        $article = new Article();
        $artileCount = count($article->all());

        $subjectCount = count((new Subject())->all());
        

        $posts = new Post();
        $posts = $posts->all();
        $postCount = count($posts);
        session_start();
        $user_given_name = $_SESSION['given_name'];

        $data = [
            "users" => $users,
            "userCount" => $userCount,
            "artileCount" => $artileCount,
            "subjectCount" => $subjectCount,
            "postCount" => $postCount,
            "posts" => $posts,
            "user_given_name" => $user_given_name
        ];

    
        $this->render('dashboard', $data);
    }
    public function users() {
        $users = new User();
        $users = $users->all();
        $userCount = count($users);

        $article = new Article();
        $artileCount = count($article->all());

        $subjectCount = count((new Subject())->all());
        
        
        $posts = new Post();
        $posts = $posts->all();
        $postCount = count($posts);
        session_start();
        $user_given_name = $_SESSION['given_name'];

        $data = [
            "users" => $users,
            "userCount" => $userCount,
            "artileCount" => $artileCount,
            "subjectCount" => $subjectCount,
            "postCount" => $postCount,
            "posts" => $posts,
            "user_given_name" => $user_given_name
        ];

    
        $this->render('users', $data);
    }
    public function deleteUser($id){
        $article = new User();
        if($article->deleteOne($id)){
            Utility::returnResult("OK");
        } else{
            Utility::returnResult("ERROR");
        }
    }
    public function articles() {

        $article = new Article();
        $articles = $article->all();
        $artileCount = count($articles);
        
        session_start();
        $user_given_name = $_SESSION['given_name'];

        $data = [
            "articles" => $articles,
            "artileCount" => $artileCount,
            "user_given_name" => $user_given_name
        ];

    
        $this->render('articles', $data);
    }

    public function deleteArticle($id){
        $article = new Article();
        if($article->deleteOne($id)){
            Utility::returnResult("OK");
        } else{
            Utility::returnResult("ERROR");
        }
    }
}
// }