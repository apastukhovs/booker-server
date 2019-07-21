<?

$dirPath = dirname(__FILE__);
include_once $dirPath . '/../../libs/controllers/RoomsController.php';
include_once $dirPath . '/../../libs/SQL.php';
include_once $dirPath . '/../../libs/MySql.php';
include_once $dirPath . '/../../libs/Server.php';
include_once $dirPath . '/../../config.php';

$rooms = new RoomsController();
$server = new Server($rooms);