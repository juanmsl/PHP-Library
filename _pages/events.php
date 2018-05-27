<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Eventos"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Eventos</h1>
            <?php if(USER_IS_ADMIN) { ?>
                <section class="pw-buttons-container">
                    <button class="pw-button" id="create-event">Agregar un evento</button>
                </section>
                <span class="pw-horizontal-line"></span>
            <?php } ?>
            <form method="GET" class="pw-form inline">
                <section class="pw-form-fields">
                    <input type="text" name="search" class="pw-form-item" value="<?php echo $value; ?>" placeholder="Busqueda"/>
                    <select name="category" class="pw-form-item" id="event-category">
                        <option value="">Categoria</option>
                        <option value="name">Nombre</option>
                        <option value="place">Lugar</option>
                    </select>
                </section>
                <button type="submit" class="pw-form-button pw-form-center" name="search-event">Buscar</button>
            </form>
            <?php if($events->num_rows == 0) { ?>
                <section class="not-found">
                    <h1>No se encontraron eventos registrados</h1>
                </section>
            <?php } else { ?>
                <section class="pw-equipments-gallery">
                    <?php while($event = $events->fetch_object()) { ?>
                        <arcticle class="pw-equipments-equipment">
                            <h4 class="pw-equipments-equipment-name"><?php echo $event->name; ?></h4>
                            <p class="pw-equipments-equipment-item"><?php echo $event->date; ?></p>
                            <p class="pw-equipments-equipment-item"><?php echo $event->place; ?></p>
                            <p class="pw-equipments-equipment-item">n inscritos de <?php echo $event->guest_number; ?></p>
                            <button class="pw-button thin expanded">Suscribirme</button>
                            <?php if(USER_IS_ADMIN) { ?>
                                <button class="pw-button pw-red delete-event">Eliminar</button>
                            <?php } ?>
                        </arcticle>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#event-category").val("<?php echo $field; ?>");
    </script>
</html>