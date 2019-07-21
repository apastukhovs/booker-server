<?

$dirPath = dirname(__FILE__);

include_once $dirPath . '/../../config.php';
include_once $dirPath . '/../Server.php';
include_once $dirPath . '/../SQL.php';
include_once $dirPath . '/../MySql.php';
include_once $dirPath . '/../models/EventsModel.php';

class EventsController 
{
    private $model;

    public function __construct()
    {
        $this->model = new EventsModel();
    }

    public function allEvents($functionParams, $queryParams)
    {
        $result = $this->model->allEvents($functionParams, $queryParams);
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