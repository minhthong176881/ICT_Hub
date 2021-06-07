<?php
require_once 'common/utility.php';

class User
{
    private $user;

    public function __construct()
    {
        $this->user = DB::getInstance()->selectCollection('users');
    }

    public function all()
    {
        $list = [];
        $req = $this->user->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getOneAuth($username, $password)
    {
        $req = $this->user->findOne(['username' => strtolower($username), 'password' => $password]);
        return $req;
    }

    public function getByUsername($username)
    {
        $req = $this->user->findOne(['username' => strtolower($username)]);
        return $req;
    }

    public function getById($id)
    {
        $req = $this->user->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }
    public function deleteOne($id){
        return $this->user->deleteOne(['_id' => new MongoDB\BSON\ObjectID( $id )]);
    }

    public function insert($account)
    {
        $rt = $this->getByUsername($account['username']);

        if (!is_null($rt)) {
            return false;
        }

        $this->user->insertOne($account);

        return true;
    }

    public function search($query)
    {
        $users = $this->all();
        $list = [];
        foreach ($users as $user) {
            if (str_contains(strtolower($user->username), $query) || strpos(strtolower($user->given_name), $query) || strpos(strtolower($user->family_name), $query)) array_push($list, $user);
        }
        return $list;
    }

    public function update($id, $user)
    {
        $req = $this->user->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id)],
            ['$set' => $user]
        );
        return $req->getModifiedCount();
    }
}
