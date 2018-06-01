<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Equipos"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Equipos</h1>
            <?php if(USER_IS_ADMIN) { ?>
                <section class="pw-buttons-container">
                    <button class="pw-button" id="create-equipment">Agregar un equipo</button>
                </section>
                <span class="pw-horizontal-line"></span>
            <?php } ?>
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
                            <h4 class="pw-equipments-equipment-name"><?php echo $equipment->name; ?></h4>
                            <p class="pw-equipments-equipment-item"><?php echo $equipment->manufacturer; ?></p>
                            <p class="pw-equipments-equipment-item">Número serial <?php echo $equipment->serial_number; ?></p>
                            <p class="pw-equipments-equipment-item"><?php echo $equipment->quantity; ?> disponibles</p>
                            <button 
                                equipmentid="<?php  echo $equipment->id; ?>"
                                equipmentname="<?php  echo $equipment->name; ?>"
                                class="pw-button thin expanded select-equipment" target="#modal-reserve-equipment">Solicitar</button>
                            <?php if(USER_IS_ADMIN) { ?>
                                <button equipmentid="<?php echo $equipment->id; ?>" class="pw-button thin transparent expanded delete-equipment">Eliminar</button>
                            <?php } ?>
                        </arcticle>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "modal_reserve_equipment.php"); ?>
        <?php include(INCLUDES . "modal_create_equipment.php"); ?>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#equipment-category").val("<?php echo $field; ?>");
    </script>
</html>