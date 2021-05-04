<?php
require_once 'controllers/base_controller.php';
require_once 'models/semester.php';
use OpenApi\Annotations as OA;

class SemestersController extends BaseController {
    private $semester;
    function __construct()
    {
        $this->semester = new Semester();
        $this->folder = 'semesters';
    }

    /**
   * @OA\Get(
   *     path="/?controller=semesters",
   *     summary="Return all semester",
   *     description="Return all semester",
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
        $semsters = $this->semester->all();
        $data = array('semesters' => $semsters);
        $this->render('index', $data);
    }
}