<?php
namespace Model;
require_once 'connection.php';
use DB;
use MongoDB\BSON\ObjectId;

class Comment {
    private $post;
    
    public function __construct()
    {
        $this->post = DB::getInstance()->selectCollection('posts');
    }

    public function push($postId, $comment)
    {
        $this->post->updateOne(['_id' => new ObjectId($postId)],
                            ['$push' => ['comments' => $comment]]);
    }

    public function getAllInPost($postCollection)
    {   
        
        $commentWithUserDetail = $postCollection->aggregate([
            ['$addFields' => ['comments' => ['$ifNull' => ['$comments', [ ]] ]]],
            ['$lookup' => ['from' => 'users', 'localField' => 'comments._id', 'foreignField' => '_id', 'as' => 'user_detail']]
        ]);

        return $commentWithUserDetail;
    }
}