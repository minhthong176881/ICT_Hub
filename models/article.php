<?php
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
}