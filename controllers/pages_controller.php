<?php

require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/tag.php');
require_once('models/subject.php');
require_once('models/semester.php');
require_once('models/article.php');
require_once('models/user.php');

class PagesController extends BaseController
{
    public function home()
    {
        $semester = new Semester();
        $semsters = $semester->all();
        $data = array('semesters' => $semsters);
        $this->render('home', $data);
    }

    public function semester()
    {
        if (isset($_GET['id'])) {
            $semester = new Semester();
            $subject = new Subject();
            $subjects = [];
            $selectedSemester = $semester->getById($_GET['id']);
            foreach ($selectedSemester->subjects as $item) {
                $sub = $subject->getById($item->_id);
                array_push($subjects, $sub);
            }
            $data = array('semester' => $selectedSemester, 'subjects' => $subjects);
            $this->render('semester', $data);
        } else $this->render('error');
    }

    public function subject()
    {
        $subject = new Subject();
        $article = new Article();
        $semester = new Semester();
        $articles = [];
        if (isset($_GET['id'])) {
            if (!isset($_GET['articleId'])) $selectedArticle = $article->all()[0];
            else $selectedArticle = $article->getById($_GET['articleId']);
            $selectedSubject = $subject->getById($_GET['id']);
            $selectedSemester = $semester->getBySubjectId($_GET['id']);
            foreach ($selectedSubject->articles as $item) {
                $a = $article->getById($item->_id);
                array_push($articles, $a);
            }
            $data = array('semester' => $selectedSemester, 'subject' => $selectedSubject, 'articles' => $articles, 'selectedArticle' => $selectedArticle);
            $this->render('subject', $data);
        }
        if (isset($_GET['articleId'])) {
            $selectedArticle = $article->getById($_GET['articleId']);
            $selectedSubject = $subject->getByArticleId($_GET['articleId']);
            $selectedSemester = $semester->getBySubjectId($selectedSubject->_id);
            foreach ($selectedSubject->articles as $item) {
                $a = $article->getById($item->_id);
                array_push($articles, $a);
            }
            $data = array('semester' => $selectedSemester, 'subject' => $selectedSubject, 'articles' => $articles, 'selectedArticle' => $selectedArticle);
            $this->render('subject', $data);
        }
    }

    public function contact()
    {
        $this->render('contact');
    }

    public function blog()
    {
        $post = new Post();
        $tag = new Tag();
        $posts = $post->all();
        $tags = $tag->all();
        $data = array('posts' => $posts, 'tags' => $tags);
        $this->render('blog', $data);
    }

    public function about()
    {
        $this->render('about');
    }

    public function course()
    {
        $subject = new Subject();
        $subjects = $subject->all();
        $data = array('subjects' => $subjects);
        $this->render('course', $data);
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $query = strtolower($_GET['search']);
            $post = new Post();
            $posts = $post->search($query);
            $tag = new Tag();
            $tags = $tag->search($query);
            $user = new User();
            $users = $user->search($query);
            $subject = new Subject();
            $subjects = $subject->search($query);
            $article = new Article();
            $articles = $article->search($query);
            $semester = new Semester();
            $semesters = $semester->search($query);
            $this->render('search', ['posts' => $posts, 'tags' => $tags, 'users' => $users, 'subjects' => $subjects, 'articles' => $articles, 'semesters' => $semesters, 'query' => $_GET['search']]);
        }
    }

    function send_mail()
    {
        if (isset($_POST['send'])) {
            $to_email = $_POST['to'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $to = $to_email;
            $subject = $subject;
            $txt = $message;
            $headers = "From: admin@gmail.com" . "\r\n" .
                "CC: anymail@example.com";
            mail($to, $subject, $txt, $headers);
        }
        $this->view->render('hello/send_mail');
    }

    public function error()
    {
        $this->render('error');
    }
}
