<?

$dirPath = dirname(__FILE__);

include_once $dirPath . '/../../config.php';
include_once $dirPath . '/../SQL.php';
include_once $dirPath . '/../MySql.php';

class RoomsModel
{
    public function getRooms()
    {
        try
        {
            $mysql = new MySql();
            $mysql->setSql("SELECT id, name FROM booker_rooms");
            $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}