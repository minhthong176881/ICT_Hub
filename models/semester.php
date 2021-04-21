<?php
class Semester {
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    static function all() {
        $list = [];
        $db = DB::getInstance();
        $req = $db->selectCollection("semesters")->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }
}