<?php
class BaseController
{
    protected $folder;
    function __construct()
    {
        
        $controller = get_class($this);
        $controller = lcfirst(substr($controller, 0, strpos($controller, "Controller")));
        $this->folder = $controller;
        // exit();
        //made by NhonDZ
    }

    function render($file, $data = null)
    {
        $viewFile = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($viewFile)) {
            if ($data) {
                if (is_array($data))
                    extract($data);
            }
            ob_start();
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/layouts/application.php');
        } else {
            header('Location: index.php?controller=pages&action=error');
        }
    }
}
