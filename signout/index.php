<?php

require_once("../global.php");
define('SERVICE_ID', 'signout');

session_destroy();
setcookie('rememberme', false, time() - 3600, '/');
setcookie('rememberme_token', '-', time() - 3600, '/');

unset($_COOKIE['rememberme']);
unset($_COOKIE['rememberme_token']);

Core::Redirect(INDEX);

?>