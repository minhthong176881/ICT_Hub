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
        $post = $this->post->aggregate([
            ['$match' => ['_id' => new \MongoDB\BSON\ObjectId($id)]],
            ['$addFields' => ['comments' => ['$ifNull' => ['$comments', [ ]] ]]],
            ['$lookup' => ['from' => 'users', 'localField' => 'comments.user_id', 'foreignField' => '_id', 'as' => 'user_detail']],
            ['$addFields' =>
                ['comments' => [
                    '$map' => [
                        'input' => '$comments',
                        'in' => [
                            '$mergeObjects' => [
                                '$$this',
                                ['$arrayElemAt' => [
                                        '$user_detail',
                                        [
                                            '$indexOfArray' => [
                                                '$user_detail._id',
                                                '$$this.user_id'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]]],
                ['$project' => ['user_detail' => 0, 'comments.email' => 0, 'comments._id' => 0, 'comments.password' => 0, 'comments.class' => 0, 'comments.external' => 0, 'comments.school_year' => 0]]
        ])->toArray();
        
        return $post[0];
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
