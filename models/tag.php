<?php
class Tag {
    private $tag;
    
    public function __construct()
    {
        $this->tag = DB::getInstance()->selectCollection('tags');
    }

    public function all() {
        $list = [];
        $req = $this->tag->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getByName($tag) {
        $req = $this->tag->findOne(['name' => strtolower($tag)]);
        return $req;
    }

    public function getById($id) {
        $req = $this->tag->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }

    public function update($id, $inc) {
        $count = $this->getById($id)->count;
        $req = $this->tag->updateOne(['_id' => new MongoDB\BSON\ObjectID($id)], ['$set' => ['count' => $count + $inc]]);
        return $req;
    }

    public function search($query) {
        $tags = $this->all();
        $list = [];
        foreach ($tags as $tag) {
            if (str_contains(strtolower($tag->name), $query)) array_push($list, $tag);
        }
        return $list;
    }
}