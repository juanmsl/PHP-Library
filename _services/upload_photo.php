<?php

require_once("../global.php");
define('SERVICE_ID', 'upload');

@$obj->status = 400;

if(isset($_POST["fileupload"])) {
    
    $obj->status = 200;
    
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"];
    } else {
        if (!file_exists(MEDIA)) {
            mkdir(MEDIA, 0777 , true);
        }
        
        $filename = MEDIA . date("Y-m-d-h-i-s-a", time()) . "-" . $_FILES["file"]["name"];
        
        move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
    }
    
} else {
    $obj->status = 500;
}

$myJSON = json_encode($obj);
echo $myJSON;

?>