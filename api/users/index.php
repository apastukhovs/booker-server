<?
$dirPath = dirname(__FILE__);

include_once $dirPath . '/../../libs/Server.php';
include_once $dirPath . '/../../libs/SQL.php';
include_once $dirPath . '/../../libs/MySql.php';
include_once $dirPath . '/../../config.php';
include_once $dirPath . '/../../libs/controllers/UsersController.php';

$users = new UsersController();
$server = new Server($users);