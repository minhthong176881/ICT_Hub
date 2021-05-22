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

    public function getSingle($username, $password) { 
        $req = $this->user->findOne(['username' => strtolower($username), 'password' => md5($password)]);
        return $req;
        // if ($req) return 1;
        // else return 0;
    }

    public function insert($username, $password)
    {
        $rt = $this->getSingle($username, $password);

        if (!is_null($rt)) {
            return false;
        }

        $this->user->insertOne(['username' => strtolower($username), 'password' => md5($password)]);

        return true;
    }
}