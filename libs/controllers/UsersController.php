<?
$dirPath = dirname(__FILE__);
include_once $dirPath . '/../../config.php';
include_once $dirPath . '/../Server.php';
include_once $dirPath . '/../SQL.php';
include_once $dirPath . '/../MySql.php';
include_once $dirPath . '/../models/UsersModel.php';

class UsersController
{
    private $model;
    public function __construct()
    {
        $this->model = new UsersModel();
    }

    public function getUsers($functionParams, $queryParams)
    {
        $result = $this->model->getUsers($functionParams, $queryParams);
        return $result;
    }

    public function postUsers($functionParams, $queryParams)
    {
        $result = $this->model->insertUser($functionParams, $queryParams);
        return $result;
    }

    public function putUsers($functionParams, $queryParams)
    {
        if (isset($queryParams['id']))
        {
            $result = $this->model->updateUser($functionParams, $queryParams);
        }
        else
        {
            $result = $this->model->login($queryParams);    
        }
        return $result;
    }

    public function deleteUsers($functionParams, $queryParams)
    {
        $result = $this->model->deleteUser($functionParams, $queryParams);
        return $result;
    }
}