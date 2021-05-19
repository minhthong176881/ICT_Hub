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
}