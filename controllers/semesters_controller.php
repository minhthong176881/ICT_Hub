<?php
require_once 'controllers/base_controller.php';
require_once 'models/semester.php';

class SemestersController extends BaseController {
    function __construct()
    {
        $this->folder = 'semesters';
    }

    public function index() {
        $semsters = Semester::all();
        $data = array('semesters' => $semsters);
        $this->render('index', $data);
    }
}