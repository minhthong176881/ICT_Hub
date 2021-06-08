<?php
class Lecturer {
    public $lecturer;

    function __construct()
    {
        $this->lecturer = DB::getInstance()->selectCollection('lecturers');
    }

    function all() {
        $list = [];
        $req = $this->lecturer->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getById($id) { 
        $req = $this->lecturer->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }

    public function getBySubjectId($id) {
        $list = $this->all();
        $selectedLecturer = null;
        foreach ($list as $item) {
            foreach($item->subjects as $subject) {
                if ($subject->_id == $id) $selectedLecturer = $item;
            }
        }
        return $selectedLecturer;
    }

    public function search($query) {
        $lecturers = $this->all();
        $list = [];
        foreach ($lecturers as $lecturer) {
            if (str_contains(strtolower($lecturer->name), $query)) array_push($list, $lecturer);
        }
        return $list;
    }
}