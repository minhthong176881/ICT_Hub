<?php
require_once 'controllers/base_controller.php';

class AdminController extends BaseController {
    function __construct()
    {
        $this->folder = 'admin';
    }

    public function render($file, $data = null) {
        $viewFile = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($viewFile)) {
            if ($data) {
                if (is_array($data))
                    extract($data);
            }
            ob_start();
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/admin/layouts/index.php');
        } else {
            header('Location: index.php?controller=pages&action=error');
        }
    }

    public function index() {
        $this->render('dashboard');
    }
}