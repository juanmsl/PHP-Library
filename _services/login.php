<?php

require_once("../global.php");
define('SERVICE_ID', 'login');

if(isset($_POST["login-form"])) {
    $entry =        $_POST["entry"];
    $password =     $_POST["password"];
    
    $user = User::get($entry, $password, true);
    
    if($user) {
        $mail = $user->email;
        $asunto = "Logeado Javelibrary";
        $mensaje = "te has logueado exitosamente";
        $de = "javelibrary@gmail.com";
        mail($mail,$asunto,$mensaje,"From: $de\n");
        $_SESSION['USER_NAME'] = $user->username;
		$_SESSION['USER_PASS'] = $user->password;
		$_SESSION['set_cookies'] = true;
		
		Core::Redirect(CHECK);
    } else {
        $_SESSION["login-form-message"] = "El usuario/correo o contraseña son incorrectos";
    }
}

Core::redirect(INDEX);

?>