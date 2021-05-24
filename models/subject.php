<?php
require_once 'vendor/autoload.php';

class Subject {
    private $subject;
    
    public function __construct()
    {
        $this->subject = DB::getInstance()->selectCollection('subjects');
    }

    public function all() {
        $list = [];
        $req = $this->subject->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getById($id) {
        $subject = $this->subject->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $subject;
    }
}