<?php
$controllers = array(
    'pages' => ['home', 'contact', 'blog', 'about', 'course', 'semester', 'subject', 'error'],
    'semesters' => ['index'],
    'articles' => ['index'],
    'users' => ['login', 'postLogin', 'all', 'register', 'postRegister', 'logout', 'externalLogin', 'externalRegister'],
    'posts' => ['post'],
    'admin' => ['index']
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}

include_once('controllers/'.$controller.'_controller.php');

$klass = str_replace('_', '', ucwords($controller, '_')).'Controller';
$controller = new $klass;
$controller->$action();