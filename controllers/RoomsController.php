<?
include_once '../libs/Server.php';
include_once '../libs/SQL.php';
include_once '../libs/MySql.php';
include_once '../config.php';
include_once '../models/RoomsModel.php';

class RoomsController
{
    public function getRooms($params)
    {
        if ($params)
        {
            $id = $params[0];
            if (is_numeric($id))
            {
                return $this->getById($id);
            }
        }
        if (isset($_GET['filter']))
        {
            return $this->CarFilter($_GET['filter']);
        }
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("SELECT id, name FROM booker_rooms");
            $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    } 
}
