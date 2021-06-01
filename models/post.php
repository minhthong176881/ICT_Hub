<?php
require_once 'vendor/autoload.php';
// use MongoDB\BSON\ObjectId;

class Post
{
    private $post;

    public function __construct()
    {
        $this->post = DB::getInstance()->selectCollection('posts');
    }

    public function all()
    {
        $list = [];
        $filter  = [];
        $options = ['sort' => ['created_at' => -1]];
        $req = $this->post->find($filter, $options);
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function insert($post)
    {
        $insertResult = $this->post->insertOne($post);
        return $insertResult->getInsertedCount();
    }

    public function getById($id)
    {
        $post = $this->post->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $post;
    }

    public function getByAuthorId($id)
    {
        $posts = $this->all();
        $list = [];
        foreach ($posts as $post) {
            if ($post->author->_id == $id) array_push($list, $post);
        }
        return $list;
    }

    public function getByTagName($tag)
    {
        $posts = $this->all();
        $list = [];
        foreach ($posts as $post) {
            foreach ($post->tags as $item) {
                if ($item->name == $tag) {
                    if (!in_array($post, $list))
                        array_push($list, $post);
                }
            }
        }
        return $list;
    }

    public function search($query)
    {
        $posts = $this->all();
        $list = [];
        foreach ($posts as $post) {
            if (str_contains(strtolower($post->title), $query)) array_push($list, $post);
        }
        return $list;
    }
}
