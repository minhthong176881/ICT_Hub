<?php

use Common\Utility;
use ICT_Hub\models;

require_once 'controllers/base_controller.php';
require_once('models/user.php');
require_once('models/article.php');
require_once('models/subject.php');
require_once('models/post.php');


class AdminController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                header('Location: index.php?controller=pages&action=error');
            }
        } else {
            header('Location: index.php?controller=users&action=login&from='.urlencode($_SERVER['REQUEST_URI']));
        }
    }

    public function render($file, $data = null)
    {
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

    public function index()
    {
        $users = new User();
        $users = $users->all();
        $userCount = count($users);

        $article = new Article();
        $artileCount = count($article->all());

        $subjectCount = count((new Subject())->all());


        $posts = new Post();
        $posts = $posts->all();
        $postCount = count($posts);
        
        
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
    public function users()
    {
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
        if (isset($_SESSION['given_name']) && !empty($_SESSION['given_name'])) {
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
    }
    public function deleteUser($id)
    {
        $article = new User();
        if ($article->deleteOne($id)) {
            Utility::returnResult("OK");
        } else {
            Utility::returnResult("ERROR");
        }
    }
    public function articles()
    {

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
    public function createArticle(){
        $subjects = new Subject();
        $subjects = $subjects->all();

        session_start();
        $user_given_name = $_SESSION['given_name'];
        $userId = $_SESSION['userId'];
        $data = [
            "subjects" => $subjects,
            "user_given_name" => $user_given_name,
            "userId" => $userId
        ];
        $this->render('createArticle', $data);
    }
    public function addArticle($title, $inputSubject, $inputSubjectId, $content){
        try {
            $subjectObj = new Subject();
            // $subject = $subjectObj->getById($inputSubjectId);
            $articleObj = new Article();

            $article = [
                "title" => $title,
                "html" => $content
            ];
            $result1 = $articleObj->insertOne($article);
            // array_push($subject->articles, $article);
            $result2 = $subjectObj->addArticleToSubject($inputSubjectId, $article);
            if ($result1 && $result2) {
                Utility::returnResult("OK");
            } else {
                Utility::returnResult("ERROR");
            }
        } catch (Exception $e) {
            Utility::returnResult("ERROR");
        }
    }

    public function deleteArticle($id)
    {
        $article = new Article();
        if ($article->deleteOne($id)) {
            Utility::returnResult("OK");
        } else {
            Utility::returnResult("ERROR");
        }
    }
}
// }