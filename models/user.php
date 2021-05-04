<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class User {
    private $user;
    public function __construct()
    {
        $this->user = DB::getInstance()->selectCollection('users');
    }
    public function login($username, $password) { 
        $req = $this->user->find({'username': $username, 'password': md5($password)});
        if ($req) return 1;
        else return 0;
    }
}