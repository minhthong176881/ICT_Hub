<?php
require_once("models/user.php");
require_once("models/post.php");
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
            Utility::debug($_POST);
            header('Location: '. (!empty($_POST['from']) ? $_POST['from'] : 'index.php'));
         } else {
            $this->render('login', ['loginSuccess' => false, 'username' => $username]);
         }
      } else {
         $this->render('login');
      }
   }

   private function sessionLogin($account)
   {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = $account['username'];
      $_SESSION['given_name'] = $account['given_name'];
      $_SESSION['userId'] = $account['_id'];
      $_SESSION['role'] = $account['role'] ?? 'student';
   }

   private function sessionLogout()
   {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }
      unset($_SESSION['logged_in']);
      unset($_SESSION['username']);
      unset($_SESSION['given_name']);
      unset($_SESSION['userId']);
      unset($_SESSION['role']);
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
            // Utility::debug($account);
            $result = $this->user->getByUsername($account['email']);
            if (!is_null($result)) {
               if (isset($result['external']) && $result['external'] == true) {
                  // login success
                  $this->sessionLogin($result);
                  header('Location: '. (!empty($_POST['from']) ? $_POST['from'] : 'index.php'));
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

            // Utility::debug($accountJson);
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
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
         header('Location: '. (!empty($_GET['from']) ? $_GET['from'] : 'index.php'));
      } else {
         $this->render('login');
      }
   }

   public function register()
   {
      $this->render('register');
   }

   public function profile()
   {
      if (isset($_GET['id'])) {
         $profile = $this->user->getById($_GET['id']);
         $post = new Post();
         $posts = $post->getByAuthorId($_GET['id']);
         $listTag = [];
         foreach ($posts as $post) {
            foreach ($post->tags as $tag) {
               if (!in_array($tag->name, $listTag)) {
                  array_push($listTag, $tag->name);
               }
            }
            unset($post->author);
         }
         $profile = (object) array_merge((array) $profile, array('posts' => $posts, 'tags' => $listTag));
         if (isset($_GET['option'])) {
            switch ($_GET['option']) {
               case '1':
                  $this->render('profile', ['user' => $profile, 'option' => 1]);
                  break;
               case '2':
                  $this->render('profile', ['user' => $profile, 'option' => 2]);
                  break;
               case '3':
                  $this->render('profile', ['user' => $profile, 'option' => 3]);
                  break;
               default:
                  $this->render('profile', ['user' => $profile, 'option' => 0]);
                  break;
            }
         } else $this->render('profile', ['user' => $profile, 'option' => 0]);
      }
   }

   public function edit()
   {
      session_start();
      if (isset($_GET['id']) && $_SESSION['userId'] == $_GET['id']) {
         $profile = $this->user->getById($_GET['id']);
         $this->render('edit_profile', ['user' => $profile]);
      } else header('Location: index.php?controller=pages&action=error');
   }

   public function editInfo()
   {
      session_start();
      if (isset($_GET['id']) && $_GET['id'] == $_SESSION['userId']) {
         if (isset($_POST['given_name']) && isset($_POST['family_name'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : "";
            $class = isset($_POST['class']) ? $_POST['class'] : "";
            $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : "";
            $user = [
               'given_name' => $_POST['given_name'],
               'family_name' => $_POST['family_name'],
               'email' => $email,
               'class' => $class,
               'school_year' => $school_year
            ];
            $res = $this->user->update($_GET['id'], $user);
            echo $res;
         } else header('Location: index.php?controller=pages&action=error');
      } else header('Location: index.php?controller=pages&action=error');
   }
}
