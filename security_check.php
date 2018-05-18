<?php

require_once("global.php");

if (!LOGGED_IN) {
	header("Location: " . INDEX);
	exit;
}

if (isset($_SESSION['set_cookies']) && $_SESSION['set_cookies'] === true) {
	setcookie('rememberme', 'true', time() + 2592000, '/');
	setcookie('rememberme_token', USER_HASH, time() + 2592000, '/');
	setcookie('rememberme_name', USER_NAME, time() + 2592000, '/');
	unset($_SESSION['set_cookies']);
}

$redirMode = HOME;

if (isset($_SESSION['page-redirect'])) {
	$redirMode = $_SESSION['page-redirect'];
	unset($_SESSION['page-redirect']);
}

?>

<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Redirecting..."; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <script type="text/javascript">
            window.location.replace('<?php echo $redirMode; ?>');
        </script>
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=<?php echo $redirMode; ?>">
        </noscript>
        <p>
            If you are not automatically redirected, please <a href="<?php echo $redirMode; ?>" id="manual_redirect_link">click here</a>
        </p>
    </body>
</html>
