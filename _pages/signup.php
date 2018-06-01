<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Sign up"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <section class="pw-cover">
            <section class="pw-form-container">
                <form class="pw-form" method="POST" action="<?php echo SERVICES . "register.php"; ?>">
                    <img src="<?php echo RESOURCES . "images/favicon.png"; ?>" alt="Biblioteca icono" class="pw-form-logo"></img>
                    <h1 class="pw-form-title"><?php echo SITE_NAME; ?></h1>
                    <input type="hidden" name="type" value="guest" />
                    <input type="text" name="username" class="pw-form-item" placeholder="Usuario" required />
                    <input type="email" name="email" class="pw-form-item" placeholder="Correo" required />
                    <input type="email" name="emailconfirm" class="pw-form-item" placeholder="Confirmar correo" required />
                    <input type="password" name="password" class="pw-form-item" placeholder="Contraseña" required />
                    <input type="password" name="passwordconfirm" class="pw-form-item" placeholder="Confirmar contraseña" required />
                    <output class="pw-form-message">
                        <?php
                            if(isset($_SESSION["register-form-message"])) {
                                echo $_SESSION["register-form-message"];
                                unset($_SESSION["register-form-message"]);
                            }
                        ?>
                    </output>
                    <button class="pw-form-button" name="register-form">Registrarme</button>
                    <a href="<?php echo INDEX; ?>" class="pw-form-link">¡Inicia sesión!</a>
                </form>
            </section>
        </section>
        
        <?php include(INCLUDES . "footer.php") ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
</html>