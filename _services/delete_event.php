<?php

require_once("../global.php");
define('SERVICE_ID', 'delete_event');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["delete-event"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'delete-event'";
} else {
    @$response->success = 1;
    
    $id = $_POST["event-id"];
    
    $result = Event::delete($id);
    
    if($result) {
        $response->message = "Evento eliminado";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>