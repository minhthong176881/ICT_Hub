<?php

use Common\Utility;
use ICT_Hub\models;

require_once 'controllers/base_controller.php';
require_once('models/user.php');
require_once('models/article.php');
require_once('models/subject.php');
require_once('models/post.php');
require_once('models/semester.php');


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
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_given_name = $_SESSION['given_name'];
        $userId = $_SESSION['userId'];
        $data = [
            "subjects" => $subjects,
            "user_given_name" => $user_given_name,
            "userId" => $userId
        ];
        $this->render('createArticle', $data);
    }
    public function editArticles(){
        $articleId = $_GET['_id'];
        $article = new Article();
        $article = $article->getById($articleId);

        $user_given_name = $_SESSION['given_name'];

        $subjectObj = new Subject();
        $subjects = $subjectObj->all();

        $currSubject = $subjectObj->getByArticleId($articleId);

        $data = [
            "subjects" => $subjects,
            "article" => $article,
            "user_given_name" => $user_given_name,
            "currSubject" => $currSubject
        ];
        $this->render('editArticle', $data);
    }
    public function addArticle($title, $inputSubjectId, $content){
        try {
            $subjectObj = new Subject();
            // $subject = $subjectObj->getById($inputSubjectId);
            $articleObj = new Article();

            $article = [
                "title" => $title,
                "html" => $content
            ];
            $result1 = $articleObj->insertOne($article);
            $article['_id'] = $result1->getInsertedId();
            
            $result2 = $subjectObj->addArticleToSubject($inputSubjectId, $article);
            if ($result1->getInsertedCount() && $result2->getModifiedCount()) {
                Utility::returnResult("OK");
            } else {
                Utility::returnResult("ERROR");
            }
        } catch (Exception $e) {
            Utility::returnResult("ERROR");
        }
    }
    public function updateArticle($title, $inputSubjectId, $content, $articleId){
        try {
            $subjectObj = new Subject();
            // $subject = $subjectObj->getById($inputSubjectId);
            $articleObj = new Article();

            $article = [
                "title" => $title,
                "html" => $content
            ];
            $result1 = $articleObj->updateOne($articleId, $article);
            $article = $articleObj->getById($articleId);
            $result2 = $subjectObj->updateArticleOfSubject($inputSubjectId, $article);
            if ($result1->getModifiedCount() && $result2->getModifiedCount()) {
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
    public function subjects()
    {

        $subject = new Subject();
        $subjects = $subject->all();
        // $artileCount = count($articles);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_given_name = $_SESSION['given_name'];

        $data = [
            "subjects" => $subjects,
            "user_given_name" => $user_given_name
        ];


        $this->render('subjects', $data);
    }
    public function createSubject(){
        $semesters = new Semester();
        $semesters = $semesters->all();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_given_name = $_SESSION['given_name'];
        $userId = $_SESSION['userId'];
        $data = [
            "semesters" => $semesters,
            "user_given_name" => $user_given_name,
            "userId" => $userId
        ];
        $this->render('createSubject', $data);
    }
    public function addSubject($name, $inputSemesterId, $description){
        try {
            $subjectObj = new Subject();
            // $subject = $subjectObj->getById($inputSubjectId);
            $semesterObj = new Semester();

            $subject = [
                "name" => $name,
                "description" => $description,
                "articles" => (array) []
            ];
            $result1 = $subjectObj->insertOne($subject);
            $subject['_id'] = $result1->getInsertedId();

            $subject = array_diff_key($subject, ["description" => "nonsense", "articles" => "nonsense"]);
            
            $result2 = $semesterObj->addSubjectToSemester($inputSemesterId, $subject);
            if ($result1->getInsertedCount() && $result2->getModifiedCount()) {
                Utility::returnResult("OK");
            } else {
                Utility::returnResult("ERROR");
            }
        } catch (Exception $e) {
            Utility::returnResult("ERROR");
        }
    }

    public function deleteSubject($id)
    {
        $subject = new Subject();
        if ($subject->deleteOne($id)) {
            Utility::returnResult("OK");
        } else {
            Utility::returnResult("ERROR");
        }
    }
}
// }