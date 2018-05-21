<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Home"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <section class="pw-cover">
            <form class="pw-form" method="POST" action="<?php echo SERVICES . "login.php"; ?>">
                <img src="<?php echo RESOURCES . "images/favicon.png"; ?>" alt="Biblioteca icono" class="pw-form-logo"></img>
                <h1 class="pw-form-title">Biblioteca PUJA</h1>
                <input type="text" name="entry" class="pw-form-item" placeholder="Correo, Usuario" required />
                <input type="password" name="password" class="pw-form-item" placeholder="Contraseña" required />
                <output class="pw-form-message">
                    <?php
                        if(isset($_SESSION["login-form-message"])) {
                            echo $_SESSION["login-form-message"];
                            unset($_SESSION["login-form-message"]);
                        }
                    ?>
                </output>
                <button class="pw-form-button" name="login-form">Iniciar sesión</button>
                <a href="<?php echo SIGNUP; ?>" class="pw-form-link">¡Registrate!</a>
            </form>
        </section>
        
        <?php include(INCLUDES . "footer.php") ?>
    </body>
    <script src="<?php echo RESOURCES . "js/scripts.js"; ?>"></script>
</html>