<?php
require_once 'vendor/autoload.php';
use MongoDB\BSON\ObjectId;

class Post {
    private $post;
    
    public function __construct()
    {
        $this->post = DB::getInstance()->selectCollection('posts');
    }

    public function all() {
        $list = [];
        $req = $this->post->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function insert($post) {
        $insertResult = $this->post->insertOne([
            'title' => $post->title,
            'tags' => $post->tags,
            'content' => $post->content,
            'user' => $post->user 
        ]);
        printf("Inserted %d document(s)\n", $insertResult->getInsertedCount());
    }

    // public function getById($id) {
    //     $post = $this->post->findOne(['_id' => new ObjectId("$id")]);
    //     return $post;
    // }
}