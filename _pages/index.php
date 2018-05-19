<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Home"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <section class="pw-cover">
            <form class="pw-form" method="POST">
                <img src="../_resources/images/favicon.png" alt="Biblioteca icono" class="pw-form-logo"></img>
                <h1 class="pw-form-title">Biblioteca PUJA</h1>
                <input type="text" name="username" class="pw-form-item" placeholder="Correo, Usuario" required />
                <input type="password" name="password" class="pw-form-item" placeholder="Contraseña" required />
                <button class="pw-form-button">Iniciar sesión</button>
                <a href="<?php echo REGISTRO; ?>" class="pw-form-link">¡Registrate!</a>
            </form>
        </section>
        
        <?php include(INCLUDES . "footer.php") ?>
    </body>
    <script src="../_resources/js/scripts.js"></script>
</html>