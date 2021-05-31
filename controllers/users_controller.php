<?php


require_once("models/user.php");
require_once("base_controller.php");
require_once 'common/constant.php';
require_once 'common/utility.php';

use Common\Utility;
use Common\Constant;

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
         $account = [
            'username' => strtolower($_POST['username']),
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'given_name' => $_POST['given_name'],
            'family_name' => $_POST['family_name'],
            'external' => false,
            'email' => $_POST['email'],
            'class' => $_POST['class'],
            'school_year' => $_POST['school_year']
         ];
         if ($_POST['password'] === $_POST['cpassword']) {
            $isSuccess = $this->user->insert($account);
            if ($isSuccess) {
               $this->render('login', ['fromRegister' => true]);
            } else {
               unset($account['password']);
               unset($account['cpassword']);
               $this->render('register', array_merge(['registerSuccess' => false], $account));
            }
         } else {
            $this->render('register', array_merge(['isDup' => true], $account));
         }
      } else {
         $this->render('register');
      }
   }

   public function postLogin()
   {
      if (isset($_POST['username']) && isset($_POST['password'])) {
         $username = strtolower($_POST['username']);
         $result = $this->user->getByUsername($username);
         if (!is_null($result) && password_verify($_POST['password'], $result['password'])) {
            // login success
            $this->sessionLogin($result);
            header('Location: index.php');
         } else {
            $this->render('login', ['loginSuccess' => false, 'username' => $username]);
         }
      } 
      else {
         $this->render('login');
      }
   }

   private function sessionLogin($account)
   {
      session_start();
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = $account['username'];
      $_SESSION['given_name'] = $account['given_name'];
      $_SESSION['userId'] = $account['_id'];
   }

   private function sessionLogout()
   {
      session_start();
      unset($_SESSION['logged_in']);
      unset($_SESSION['username']);
      unset($_SESSION['given_name']);
      unset($_SESSION['userId']);
   }
 
   public function logout()
   {
      $this->sessionLogout();

      header('Location: index.php');
   }

   public function externalLogin()
   {
      if (isset($_POST['idToken'])) {
         $verifyUrl = '';
         if (strtolower($_POST['provider']) === 'google') {
            $verifyUrl = Constant::$ggTokenVerifyEndpoint . $_POST['idToken'];
         } else if (strtolower($_POST['provider']) === 'facebook') {
            $verifyUrl = Constant::$fbTokenVerifyEndpoint . $_POST['idToken'];
         } else {
            header('Location: index.php?controller=pages&action=error');
            return;
         }
         $options = array(
            'https' => array(
                'method'  => 'GET'
            )
         );
         $context  = stream_context_create($options);
         $result = file_get_contents($verifyUrl, false, $context);
         if ($result === false) {
            $this->render('login', ['externalSuccess' => false, 'provider' => $_POST['provider']]);
         } else {
            $accountJson = json_decode($result, true);
            $account = [];
            if (strtolower($_POST['provider']) === 'google') {
               $account = [
                  'username' => strtolower($accountJson['email']),
                  'email' => strtolower($accountJson['email']),
                  'given_name' => $accountJson['given_name']
               ];
            } else if (strtolower($_POST['provider']) === 'facebook') {
               if (isset($accountJson['error'])) {
                  $this->render('register', ['externalSuccess' => false, 'provider' => $_POST['provider']]);
                  return;
               }
               $account = [
                  'username' => strtolower($accountJson['email']),
                  'email' => strtolower($accountJson['email']),
                  'given_name' => $accountJson['first_name'],
               ];
            } else {
               header('Location: index.php?controller=pages&action=error');
               return;
            }
            Utility::debug($account);
            $result = $this->user->getByUsername($account['email']);
            if (!is_null($result)) {
               if (isset($result['external']) && $result['external'] == true) {
                  // login success
                  $this->sessionLogin(['username' => $account['email'], 'given_name' => $account['given_name'],  '_id' => $result->_id]);
                  header('Location: index.php');
               } else {
                  $this->render('login', ['loginSuccess' => false, 'external' => true]);
               }
            } else {
               $this->render('login', ['loginSuccess' => false]);
            }
         }
      }
   }

   public function externalRegister()
   {
      if (isset($_POST['idToken']) && !empty($_POST['provider'])) {
         $verifyUrl = '';
         if (strtolower($_POST['provider']) === 'google') {
            $verifyUrl = Constant::$ggTokenVerifyEndpoint . $_POST['idToken'];
         } else if (strtolower($_POST['provider']) === 'facebook') {
            $verifyUrl = Constant::$fbTokenVerifyEndpoint . $_POST['idToken'];
         } else {
            header('Location: index.php?controller=pages&action=error');
            return;
         }
         $options = array(
            'https' => array(
                'method'  => 'GET'
            )
         );
         $context  = stream_context_create($options);
         $result = file_get_contents($verifyUrl, false, $context);
         if ($result === false) {
            $this->render('register', ['externalSuccess' => false, 'provider' => $_POST['provider']]);
         } else {
            $accountJson = json_decode($result, true);
            $account = [];
            if (strtolower($_POST['provider']) === 'google') {
               $account = [
                  'username' => strtolower($accountJson['email']),
                  'email' => strtolower($accountJson['email']),
                  'given_name' => $accountJson['given_name'],
                  'family_name' => $accountJson['family_name'],
                  'external' => true
               ];
            } else if (strtolower($_POST['provider']) === 'facebook') {
               if (isset($accountJson['error'])) {
                  $this->render('register', ['externalSuccess' => false, 'provider' => $_POST['provider']]);
                  return;
               }
               $account = [
                  'username' => strtolower($accountJson['email']),
                  'email' => strtolower($accountJson['email']),
                  'given_name' => $accountJson['first_name'],
                  'family_name' => $accountJson['last_name'],
                  'external' => true
               ];
            } else {
               header('Location: index.php?controller=pages&action=error');
               return;
            }
            
            Utility::debug($accountJson);
            $isSuccess = $this->user->insert($account);
            if ($isSuccess) {
               // register success
               $this->render('login', ['fromRegister' => true]);
            } else {
               $this->render('register', ['registerSuccess' => false, 'external' => true]);
            }
         }
      }
   }

   public function login()
   {
      $this->render('login');
   }

   public function register() {
      $this->render('register');
   }
}
