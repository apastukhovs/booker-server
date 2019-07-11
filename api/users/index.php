<?
include_once '../../libs/models/UsersController.php';
include_once '../../libs/Server.php';
include_once '../../config.php';

$users = new UsersController();
$server = new RestServer($users);