<?php
class Article {
    static function all() {
        $list = [];
        $db = DB::getInstance();
        $req = $db->selectCollection("articles")->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }
}