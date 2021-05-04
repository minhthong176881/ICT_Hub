<?php
require_once("../models/user.php");
require_once("base_controller.php");

 class UsersController extends BaseController {
    public $user;
    public function __construct()
    {
       $this->user = new User();
       $this->folder = 'users';
    }
    public function login($username, $password) {
        $result = $this->user->login($username, $password);
        if ($result) {
           $this->render('after_login', $result);
        }
        else $this->render('login');
    }
 }