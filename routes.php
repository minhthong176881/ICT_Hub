<?php
namespace ICT_Hub;
$controllers = array(
    'pages' => ['home', 'contact', 'blog', 'about', 'course', 'semester', 'subject', 'search', 'liveSearch', 'error'],
    'users' => ['login', 'postLogin', 'all', 'register', 'postRegister', 'logout', 'externalLogin', 'externalRegister', 'profile', 'edit', 'editInfo'],
    'posts' => ['post', 'detail', 'save', 'tag', 'edit', 'postEdit', 'delete', 'postComment'],
    'admin' => ['index']
);

ini_set('session.cookie_httponly', 1);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) 
{
    include_once('controllers/' . $controller . '_controller.php');
    $className = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
    if (method_exists($className, $action)) {
        // nghia la day la API
        // Takes raw data from the request
        $json = file_get_contents('php://input');

        // Converts it into a PHP object
        $data = json_decode($json);
        $arrayData = (array) $data;
        $controller = new $className;
        $controller->$action(...$arrayData);

    } else {
        // tra ve trang loi
        $controller = 'pages';
        $action = 'error';
        include_once('controllers/' . $controller . '_controller.php');
        $class = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
        $controller = new $class;
        $controller->$action();
    }
} else {
    // day la UI
    include_once('controllers/' . $controller . '_controller.php');
    $class = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
    $controller = new $class;
    $controller->$action();
}
