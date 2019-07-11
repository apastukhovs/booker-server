<?
include_once '../libs/Server.php';
include_once '../libs/SQL.php';
include_once '../libs/MySql.php';
include_once '../config.php';
include_once '../models/EventsModel.php';

class EventsController 
{
    private $model;

    public function __construct()
    {
        $this->model = new EventsModel();
    }

    public function getEvents($functionParams, $queryParams)
    {
        $result = $this->model->getEvents($functionParams, $queryParams);
        return $result;
    }
    
    public function postEvents($functionParams, $queryParams)
    {
        $result = $this->model->insertEvents($functionParams, $queryParams);
        return $result;
    }
 
    public function putEvents($functionParams, $queryParams)
    {
        $result = $this->model->updateEvents($functionParams, $queryParams);
        return $result;
    }
 
    public function deleteEvents($functionParams, $queryParams)
    {
        $result = $this->model->deleteEvents($functionParams, $queryParams);
        return $result;
    }
}