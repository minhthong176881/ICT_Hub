<?php
require_once 'vendor/autoload.php';

class Subject {
    private $post;
    
    public function __construct()
    {
        $this->post = DB::getInstance()->selectCollection('subjects');
    }

    public function all() {
        $list = [];
        $req = $this->post->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    // public function getById($id) {
    //     $post = $this->post->findOne(['_id' => new ObjectId("$id")]);
    //     return $post;
    // }
}