<?php
use ICT_Hub\models;

require_once 'controllers/base_controller.php';
require_once('models/user.php');
require_once('models/article.php');
require_once('models/subject.php');
require_once('models/post.php');


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
        $user = new User();
        $userCount = count($user->all());

        $article = new Article();
        $artileCount = count($article->all());

        $subjectCount = count((new Subject())->all());
        $postCount = count((new Post())->all());

        $data = [
            "userCount" => $userCount,
            "artileCount" => $artileCount,
            "subjectCount" => $subjectCount,
            "postCount" => $postCount
        ];

    
        $this->render('dashboard', $data);
    }
}
// }