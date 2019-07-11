<?
include_once '../../libs/models/EventsController.php';
include_once '../../libs/Server.php';
include_once '../../config.php';

$events = new EventsController();
$server = new RestServer($events);