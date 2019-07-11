<?
include_once '../../libs/models/RoomsController.php';
include_once '../../libs/Server.php';
include_once '../../config.php';

$rooms = new RoomsController();
$server = new RestServer($rooms);