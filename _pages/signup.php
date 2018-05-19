<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Sign up"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <section class="pw-cover">
            <form class="pw-form" method="POST">
                <img src="../_resources/images/favicon.png" alt="Biblioteca icono" class="pw-form-logo"></img>
                <h1 class="pw-form-title">Biblioteca PUJA</h1>
                <input type="text" name="username" class="pw-form-item" placeholder="Usuario" required />
                <input type="email" name="email" class="pw-form-item" placeholder="Correo" required />
                <input type="email" name="emailconfirm" class="pw-form-item" placeholder="Confirmar correo" required />
                <input type="password" name="password" class="pw-form-item" placeholder="Contraseña" required />
                <input type="password" name="passwordconfirm" class="pw-form-item" placeholder="Confirmar contraseña" required />
                <button class="pw-form-button">Registrarme</button>
                <a href="<?php echo INDEX; ?>" class="pw-form-link">¡Inicia sesión!</a>
            </form>
        </section>
        
        <?php include(INCLUDES . "footer.php") ?>
    </body>
    <script src="../_resources/js/scripts.js"></script>
</html>