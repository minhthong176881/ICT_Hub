<?php
namespace ICT_Hub;
$controllers = array(
    'pages' => ['home', 'contact', 'blog', 'about', 'course', 'semester', 'subject', 'search', 'error'],
    'users' => ['login', 'postLogin', 'all', 'register', 'postRegister', 'logout', 'externalLogin', 'externalRegister', 'profile', 'edit', 'editInfo'],
    'posts' => ['post', 'detail', 'save', 'tag'],
    'admin' => ['index']
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}

include_once('controllers/'.$controller.'_controller.php');

$class = str_replace('_', '', ucwords($controller, '_')).'Controller';
$controller = new $class;
$controller->$action();