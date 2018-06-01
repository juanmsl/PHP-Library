<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Home"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <section class="pw-home">
                <img src="<?php echo RESOURCES . "images/favicon.png"; ?>" class="pw-home-logo"></img>
                <h1 class="pw-form-title"><?php echo SITE_NAME; ?></h1>
            </section>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
</html>