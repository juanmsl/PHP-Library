<?php

require_once("../global.php");
define('SERVICE_ID', 'create_event');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["create-event-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'create-event-form'";
} else {
    @$response->success = 1;
    $response->message = "";
    $continue = true;
    
    $name = $_POST["name"];
    $date = $_POST["date"];
    $place = $_POST["place"];
    $guest_number = $_POST["guest_number"];
    
    
    $result = Event::create($name, $date, $place, $guest_number);

    if($result) {
        $response->message = "Evento creado";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>