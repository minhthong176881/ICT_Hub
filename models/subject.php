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

    public function getByArticleId($id) {
        $subjects = $this->all();
        foreach ($subjects as $subject) {
            foreach ($subject->articles as $article) {
                if ($article->_id == $id) return $subject;
            }
        }
    }

    public function search($query) {
        $subjects = $this->all();
        $list = [];
        foreach ($subjects as $subject) {
            if (str_contains(strtolower($subject->name), $query)) array_push($list, $subject);
        }
        return $list;
    }
}