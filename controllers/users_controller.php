<?php

use Common\Utility;

require_once("models/user.php");
require_once("base_controller.php");
require_once 'common/utility.php';

class UsersController extends BaseController
{
   public $user;

   public function __construct()
   {
      parent::__construct();
      $this->user = new User();
      
   }

   public function postRegister()
   {
      if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
         Utility::debug('post register ok');
         $username = $_POST['username'];
         $password = $_POST['password'];
         $cpassword = $_POST['cpassword'];
         if ($password === $cpassword) {
            $isSuccess = $this->user->insert($username, $password);
            if ($isSuccess) {
               $this->render('login', ['fromRegister' => true]);
            } else {
               $this->render('register', ['registerSuccess' => false, 'username' => $username]);
            }
         } else {
            $this->render('register', ['isDup' => true, 'username' => $username]);
         }
      } else {
         $this->render('register');
      }
   }

   public function postLogin()
   {
      if (isset($_POST['username']) && isset($_POST['password'])) {
         $username = $_POST['username'];
         $password = $_POST['password'];
         $result = $this->user->getSingle($username, $password);
         if (!is_null($result)) {
            // login success
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
         } else {
            $this->render('login', ['loginSuccess' => false, 'username' => $username]);
         }
      } 
      else {
         $this->render('login');
      }
   }

   public function logout()
   {
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['username']);

      header('Location: index.php');
   }

   public function login()
   {
      $this->render('login');
   }

   public function register() {
      $this->render('register');
   }
}
