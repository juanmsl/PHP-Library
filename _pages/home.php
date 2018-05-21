<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Home"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php echo "Hello " . $user->username . "<br>"; ?>
        
        <?php include(INCLUDES . "footer.php") ?>
    </body>
    <script src="<?php echo RESOURCES . "js/scripts.js"; ?>"></script>
</html>