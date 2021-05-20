<?php
require_once 'controllers/base_controller.php';
require_once 'models/article.php';
use OpenApi\Annotations as OA;

class ArticlesController extends BaseController {
    private $article;
    function __construct()
    {
        $this->article = new Article();
       
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
        $articles = $this->article->all();
        $data = array('articles' => $articles);
        $this->render('index', $data);
    }
}