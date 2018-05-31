<?php

require_once("../global.php");
define('SERVICE_ID', 'reserve_book');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["request-book-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'request-book-form'";
} else {
    @$response->success = 1;
    
    $date_reservation = $_POST["time"];
    $user_id = USER_ID;
    $book_id = $_POST["book_id"];
    
    $result = Request::createBookReservation($date_reservation, $user_id, $book_id);
    
    $response->message = "Book reservation created";
    if(!$result) {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>