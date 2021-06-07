<?php

require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/tag.php');
require_once('models/subject.php');
require_once('models/semester.php');
require_once('models/article.php');
require_once('models/user.php');
require_once('models/lecturer.php');

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
                if (isset($item->_id) && !empty($item->_id)) {
                    $a = $article->getById($item->_id);
                    array_push($articles, $a);
                }
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
        $user = new User();
        $posts = $post->all();
        $tags = $tag->all();
        $users = $user->all();
        $listAuthor = [];
        foreach ($users as $u) {
            $listPost = $post->getByAuthorId($u->_id);
            $u = (object) array_merge((array) $u, array('posts' => $listPost));
            array_push($listAuthor, $u);
        }
        $data = array('posts' => $posts, 'tags' => $tags, 'authors' => $listAuthor);
        $this->render('blog', $data);
    }

    public function about()
    {
        $this->render('about');
    }

    public function course()
    {
        $subject = new Subject();
        $lecturer = new Lecturer();
        $subjects = $subject->all();
        $listSubject = [];
        foreach ($subjects as $sub) {
            $currentLecturer = $lecturer->getBySubjectId($sub->_id);
            $sub = (object) array_merge((array) $sub, array('lecturer' => $currentLecturer));
            array_push($listSubject, $sub);
        }
        $data = array('subjects' => $listSubject);
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

    public function liveSearch()
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
            $hint = "";
            if (count($posts) > 0) {
                $hint .= "<div style='background-color: #1da4dd; margin-top: 10px; color: white; text-align: center'>Posts: </div>";
                foreach ($posts as $p) {
                    $hint .= "<a href='?controller=posts&action=detail&id=" . $p->_id . "'>" . $p->title . "</a><br>";
                }
            }
            if (count($tags) > 0) {
                $hint .= "<br><div style='background-color: #1da4dd; color: white; text-align: center'>Tags: </div>";
                foreach ($tags as $t) {
                    $hint .= "<a href='?controller=posts&action=tag&tag=" . $t->name . "'>" . $t->name . "</a><br>";
                }
            }
            if (count($users) > 0) {
                $hint .= "<br><div style='background-color: #1da4dd; color: white; text-align: center'>Users: </div>";
                foreach ($users as $u) {
                    $hint .= "<a href='?controller=users&action=profile&id=" . $u->_id . "'>" . $u->given_name . "</a><br>";
                }
            }
            if (count($subjects) > 0) {
                $hint .= "<br><div style='background-color: #1da4dd; color: white; text-align: center'>Subjects: </div>";
                foreach ($subjects as $s) {
                    $hint .= "<a href='?controller=pages&action=subject&id=" . $s->_id . "'>" . $s->name . "</a><br>";
                }
            }
            if (count($articles) > 0) {
                $hint .= "<br><div style='background-color: #1da4dd; color: white; text-align: center'>Articles: </div>";
                foreach ($articles as $a) {
                    $hint .= "<a href='?controller=pages&action=subject&articleId=" . $a->_id . "'>" . $a->title . "</a><br>";
                }
            }
            if (count($semesters) > 0) {
                $hint .= "<br><div style='background-color: #1da4dd; color: white; text-align: center'>Semesters: </div>";
                foreach ($semesters as $s) {
                    $hint .= "<a href='?controller=pages&action=semester&id=" . $s->_id . "'>" . $s->name . "</a><br>";
                }
            }
            if (trim($hint) == "") {
                $response = "<span style='color: black'>No content.</span>";
            } else {
                $response = $hint;
            }
            echo $response;
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
