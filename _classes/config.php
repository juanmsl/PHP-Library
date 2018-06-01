<?php

//$config['Site']['www'] = "http://" . $_SERVER['SERVER_NAME'];
$config['Site']['www'] = "";
$config['MySQL']['hostname'] = getenv('IP');
$config['MySQL']['username'] = getenv('C9_USER');
$config['MySQL']['password'] = "phpRULEZ";
$config['MySQL']['database'] = "library";

?>