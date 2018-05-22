<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Eventos"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <?php echo PAGE_ID; ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <script src="<?php echo RESOURCES . "js/scripts.js"; ?>"></script>
</html>