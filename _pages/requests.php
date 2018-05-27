<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Solicitudes"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Solicitudes</h1>
            <?php if(count($requests) == 0) { ?>
                <section class="not-found">
                    <h1>No hay solicitudes de prestamo por el momento</h1>
                </section>
            <?php } else { ?>
                <section class="pw-requests-columns">
                    <?php foreach($requests as $item) { ?>
                        <section class="pw-requests-column">
                            <h2 class="pw-subtitle"><?php echo $item["title"] . " (" . $item["data"]->num_rows . ")"; ?></h2>
                            <section class="pw-request-column-content">
                                <?php while($request = $item["data"]->fetch_object()) { ?>
                                    <section class="pw-request">
                                        <form class="pw-form" method="POST">
                                            <h6>Solicitud <?php echo $request->id; ?></h6>
                                            <input class="pw-form-item" type="hidden" name="reservation_id" value="<?php echo $request->id; ?>" />
                                            <input class="pw-form-item" type="datetime-local" placeholder="Fecha de reserva" value="<?php echo $request->date_reservation; ?>" readonly />
                                            <input class="pw-form-item" type="text" placeholder="Usuario" value="<?php echo $request->username; ?>" readonly/>
                                            <input class="pw-form-item" type="text" placeholder="Sala" value="<?php echo "Piso " . $request->floor_number . " - Sala " . $request->room_number; ?>" readonly />
                                            <input class="pw-form-item" type="number" min="2" max="10" placeholder="Tiempo de prestamo"/>
                                            <section class="pw-request-buttons">
                                                <button class="pw-button thin">Aprobar</button>
                                                <button class="pw-button thin transparent">Denegar</button>
                                            </section>
                                        </form>
                                    </section>
                                <?php } ?>
                            </section>
                        </section>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
</html>