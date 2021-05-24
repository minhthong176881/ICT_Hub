<?php
require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/tag.php');
require_once('models/subject.php');
require_once('models/semester.php');

class PagesController extends BaseController
{
    public function home()
    {
        $semester = new Semester();
        $semsters = $semester->all();
        $data = array('semesters' => $semsters);
        $this->render('home', $data);
    }

    public function semester() {
        if (isset($_GET['id'])) {
            $semester = new Semester();
            $subject = new Subject();
            $subjects = [];
            $selectedSemester = $semester->getOne($_GET['id']);
            foreach($selectedSemester->subjects as $item) {
                $sub = $subject->getById($item->_id);
                array_push($subjects, $sub);
            }
            $data = array('semester' => $selectedSemester, 'subjects' => $subjects);
            $this->render('semester', $data);
        }
        else $this->render('error');
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

    public function about() {
        $this->render('about');
    }

    public function course() {
        $subject = new Subject();
        $subjects = $subject->all();
        $data = array('subjects' => $subjects);
        $this->render('course', $data);
    }

    public function error()
    {
        $this->render('error');
    }
}
