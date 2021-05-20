<?php
require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/tag.php');
require_once('models/subject.php');

class PagesController extends BaseController
{
    function __construct()
    {
        $this->folder = 'pages';
    }

    public function home()
    {
        $data = array(
            'name' => 'Thông đẹp trai siêu cấp vũ trụ',
            'age' => 22
        );
        $this->render('home', $data);
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
