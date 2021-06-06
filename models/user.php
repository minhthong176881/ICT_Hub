<?php
require_once 'common/utility.php';
use Common\Utility;

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

    public function getOneAuth($username, $password) { 
        $req = $this->user->findOne(['username' => strtolower($username), 'password' => $password]);
        return $req;
        // if ($req) return 1;
        // else return 0;
    }

    public function getOne($username) { 
        $req = $this->user->findOne(['username' => strtolower($username)]);
        return $req;
        // if ($req) return 1;
        // else return 0;
    }
    public function deleteOne($id){
        return $this->user->deleteOne(['_id' => new MongoDB\BSON\ObjectID( $id )]);
    }

    public function insert($account)
    {
        $rt = $this->getOne($account['username']);

        if (!is_null($rt)) {
            return false;
        }

        $this->user->insertOne($account);

        return true;
    }
}