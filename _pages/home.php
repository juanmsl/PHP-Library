<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Home"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <section class="pw-home">
                <img src="<?php echo RESOURCES . "images/favicon.png"; ?>" class="pw-home-logo"></img>
                <span class="pw-horizontal-line"></span>
                <form class="pw-form">
                    <section class="pw-home-fields">
                        <input type="text" name="search" class="pw-form-item" placeholder="Busqueda"/>
                        <section class="pw-home-selects">
                            <select name="item" class="pw-form-item">
                                <option value="">Libro</option>
                                <option value="">Equipo</option>
                            </select>
                            <select name="category" class="pw-form-item">
                                <option value="">Nombre</option>
                                <option value="">Equipo</option>
                            </select>
                        </section>
                    </section>
                    <button type="submit" class="pw-form-button pw-form-center">Buscar</button>
                </form>
            </section>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <script src="<?php echo RESOURCES . "js/scripts.js"; ?>"></script>
</html>