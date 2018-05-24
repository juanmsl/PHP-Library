<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Solicitudes"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Solicitudes</h1>
            <section>
                <section>
                    <form class="pw-form">
                        <input class="pw-form-item" type="hidden" name="reservation_id" value="" />
                        <input class="pw-form-item" type="datetime-local" placeholder="Fecha de reserva"/>
                        <input class="pw-form-item" type="text" placeholder="Usuario"/>
                        <input class="pw-form-item" type="text" placeholder="Sala"/>
                        <input class="pw-form-item" type="number" min="2" max="10" placeholder="Tiempo de prestamo"/>
                        <button class="pw-form-button">Aprobar</button>
                        <button class="pw-form-button">Denegar</button>
                    </form>
                </section>
            </section>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
</html>