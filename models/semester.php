<?php
class Semester {
    public $semester;

    function __construct()
    {
        $this->semester = DB::getInstance()->selectCollection('semesters');
    }

    function all() {
        $list = [];
        $req = $this->semester->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getById($id) { 
        $req = $this->semester->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }

    public function getBySubjectId($id) {
        $list = $this->all();
        $selectedSemester = null;
        foreach ($list as $item) {
            foreach($item->subjects as $subject) {
                if ($subject->_id == $id) $selectedSemester = $item;
            }
        }
        return $selectedSemester;
    }
}