<?php
require_once 'controllers/base_controller.php';
require_once 'models/article.php';
use OpenApi\Annotations as OA;

class ArticlesController extends BaseController {
    function __construct()
    {
        $this->folder = 'articles';
    }

    /**
   * @OA\Get(
   *     path="/?controller=articles",
   *     summary="Return all article",
   *     description="Return all article",
   *     @OA\Response(
   *         response=200,
   *         description="Success",
   *     ), 
   *     @OA\Response(
   *         response=404,
   *         description="Not found",
   *     ), 
   * )
   */
    public function index() {
        $articles = Article::all();
        $data = array('articles' => $articles);
        $this->render('index', $data);
    }
}