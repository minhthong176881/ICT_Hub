<?php
require_once 'vendor/autoload.php';
require_once('models/semester.php');

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
        $id =  new MongoDB\BSON\ObjectID($id);
        $selectedSub = null;
        foreach ($subjects as $subject) {
            foreach ($subject->articles as $article) {
                if ($article->_id == $id){
                     $selectedSub = $subject;
                }
            }
        }
        return $selectedSub;
    }

    public function search($query) {
        $subjects = $this->all();
        $list = [];
        foreach ($subjects as $subject) {
            if (str_contains(strtolower($subject->name), $query)) array_push($list, $subject);
        }
        return $list;
    }
    public function updateOne($id, $subject) {
        $req = $this->subject->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id)],
            ['$set' => $subject]
        );
        return $req->getModifiedCount();
    }
    public function addArticleToSubject($subjectId, $article) {
        $req = $this->subject->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($subjectId)],
            ['$push' => ["articles" => $article]]
        );
        return $req;
    }
    public function updateArticleOfSubject($subjectId, $article) {
        $this->deleteArticleById($article->_id);

        $req = $this->subject->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($subjectId)],
            ['$push' => ["articles" => $article]]
        );
        return $req;
    }

    public function insertOne($subject)
    {
        // $insertResult = ;
        return $this->subject->insertOne($subject);
    }
    public function deleteOne($id){
        try{
            $this->subject->deleteOne(['_id' => new MongoDB\BSON\ObjectID( $id )]);
            
            $semester = new Semester;
            $semester->deleteSubject($id);

            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function deleteArticleById($articleId) {
        $subId = $this->getByArticleId($articleId)->_id;
        $this->subject->updateOne(
            [ "_id" => $subId ],
            [ '$pull' => [ "articles" => [ "_id" => new MongoDB\BSON\ObjectID($articleId) ] ] ]
          );
    }
}