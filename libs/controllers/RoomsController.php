<?
$dirPath = dirname(__FILE__);
include_once $dirPath . '/../../config.php';
include_once $dirPath . '/../Server.php';
include_once $dirPath . '/../SQL.php';
include_once $dirPath . '/../MySql.php';
include_once $dirPath . '/../models/RoomsModel.php';



class RoomsController
{
    private $model;
    public function __construct()
    {
        $this->model = new RoomsModel();
    }

    public function getAllRooms()
    {
        $result = $this->model->getRooms();
        return $result;
    }
}
