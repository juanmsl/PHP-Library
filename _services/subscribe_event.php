<?php

require_once("../global.php");
define('SERVICE_ID', 'subscribe_event');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["subscribe-event"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'subscribe-event'";
} else {
    @$response->success = 1;
    
    $id = $_POST["event-id"];
    
    $result = Event::subscribeUser($id, USER_ID, $user->email);
    
    if($result) {
        $response->message = "Suscrito a evento";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>