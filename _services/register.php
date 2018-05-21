<?php

require_once("../global.php");
define('SERVICE_ID', 'register');

if(isset($_POST["register-form"])) {
    $username =         $_POST["username"];
    $email =            $_POST["email"];
    $emailconfirm =     $_POST["emailconfirm"];
    $password =         $_POST["password"];
    $passwordconfirm =  $_POST["passwordconfirm"];
    $type =             $_POST["type"];
    
    list($validPassword, $message) = Core::ValidatePassword($password, $passwordconfirm);
    
    $userNotExist = !User::exists($username, $email);
    
    if($validPassword) {
        if($userNotExist) {
            $user = User::create($username, $email, $password, $type, true);
            if($user) {
                $_SESSION['USER_NAME'] = $user->username;
    			$_SESSION['USER_PASS'] = $user->passhash;
    			$_SESSION['set_cookies'] = true;
    			
    			Core::Redirect(CHECK);
            } else {
                $_SESSION["register-form-message"] = "Algo sucedio mientras te registrabamos: " . Core::db()->getError();
            }
        } else {
            $_SESSION["register-form-message"] = "Este usuario ya esta registrado";
        }
    } else {
        $_SESSION["register-form-message"] = "Ingresa una contraseña valida: $message";
    }
}

Core::redirect(SIGNUP);

?>