<?php
require_once('controllers/base_controller.php');

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
        $this->render('blog');
    }

    public function about() {
        $this->render('about');
    }

    public function course() {
        $this->render('course');
    }

    public function error()
    {
        $this->render('error');
    }
}