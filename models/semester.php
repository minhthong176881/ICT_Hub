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

    public function getOne($id) { 
        $req = $this->semester->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }
}