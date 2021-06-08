<?php
require_once('models/subject.php');
class Article {
    private $article;
    
    public function __construct()
    {
        $this->article = DB::getInstance()->selectCollection('articles');
    }
    public function all() {
        $list = [];
        $req = $this->article->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }
    public function deleteOne($id){
        try{
            $this->article->deleteOne(['_id' => new MongoDB\BSON\ObjectID( $id )]);
            
            $subject = new Subject;
            $subject->deleteArticleById($id);

            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function getById($id) {
        $article = $this->article->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

        return $article;
    }

    public function search($query) {
        $articles = $this->all();
        $list = [];
        foreach ($articles as $article) {
            if (str_contains(strtolower($article->title), $query)) array_push($list, $article);
        }
        return $list;
    }
    public function updateOne($id, $article) {
        $req = $this->article->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id)],
            ['$set' => $article]
        );
        return $req;
    }
    public function insertOne($post)
    {
        // $insertResult = ;
        return $this->article->insertOne($post);
    }
}