<?php
require_once("models/user.php");
require_once("base_controller.php");

class UsersController extends BaseController
{
   public $user;

   public function __construct()
   {
      $this->user = new User();
      
   }

   public function postLogin()
   {
      if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
         $username = $_REQUEST['username'];
         $password = $_REQUEST['password'];
         $result = $this->user->login($username, md5($password));
         if (!is_null($result)) {
            $this->render('after_login', $result);
         } else $this->render('login');
      } 
      else $this->render('login');
   }

   public function login()
   {
      $this->render('login');
   }
}
