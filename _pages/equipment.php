<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Equipos"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Equipos</h1>
            <form method="GET" class="pw-form inline">
                <section class="pw-form-fields">
                    <input type="text" name="search" class="pw-form-item" value="<?php echo $value; ?>" placeholder="Busqueda"/>
                    <select name="category" class="pw-form-item" id="equipment-category">
                        <option value="">Categoria</option>
                        <option value="name">Nombre</option>
                        <option value="manufacturer">Fabricante</option>
                        <option value="serial_number">Serial</option>
                    </select>
                </section>
                <button type="submit" class="pw-form-button pw-form-center" name="search-equipment">Buscar</button>
            </form>
            <?php if($equipments->num_rows == 0) { ?>
                <section class="not-found">
                    <h1>No se encontraron equipos registrados</h1>
                </section>
            <?php } else { ?>
                <section class="pw-equipments-gallery">
                    <?php while($equipment = $equipments->fetch_object()) { ?>
                        <arcticle class="pw-equipments-equipment">
                            <img class="pw-equipments-equipment-picture" src="<?php echo MEDIA . $equipment->id . "-" . $equipment->serial_number; ?>" />
                            <h4 class="pw-equipments-equipment-name"><?php echo $equipment->name; ?></h4>
                            <p class="pw-equipments-equipment-item"><?php echo $equipment->manufacturer; ?></p>
                            <p class="pw-equipments-equipment-item">Número serial <?php echo $equipment->serial_number; ?></p>
                            <p class="pw-equipments-equipment-item"><?php echo $equipment->quantity; ?> disponibles</p>
                            <button class="pw-button thin expanded">Solicitar</button>
                        </arcticle>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#equipment-category").val("<?php echo $field; ?>");
    </script>
</html>