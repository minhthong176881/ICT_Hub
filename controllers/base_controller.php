<?php
class BaseController {
    protected $folder;

    function render($file, $data = array()) {
        $viewFile = 'views/'.$this->folder.'/'.$file.'.php';
        if (is_file($viewFile)) {
            extract($data);
            ob_start();
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/layouts/application.php');
        } else {
            header('Location: index.php?controller=pages&action=error');
        }
    }
}