<?
$dirPath = dirname(__FILE__);

include_once $dirPath . '/../../libs/controllers/EventsController.php';
include_once $dirPath . '/../../libs/SQL.php';
include_once $dirPath . '/../../libs/MySql.php';
include_once $dirPath . '/../../libs/Server.php';
include_once $dirPath . '/../../config.php';


$events = new EventsController();
$server = new Server($events);