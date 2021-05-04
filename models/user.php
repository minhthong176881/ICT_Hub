<?php
class User {
    private $user;

    public function __construct()
    {
        $this->user = DB::getInstance()->selectCollection('users');
    }

    public function all() {
        $list = [];
        $req = $this->user->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function login($username, $password) { 
        $req = $this->user->findOne(['username' => $username, 'password' => $password]);
        return $req;
        // if ($req) return 1;
        // else return 0;
    }
}