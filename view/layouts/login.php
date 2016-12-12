<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Moovett</title>

    <link rel='stylesheet prefetch'
          href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <!--LOGIN STYLESHEET-->
    <link rel="stylesheet" href="css/loginStyle.css">

    <script src=<?php echo "js/loginValidations.js"; ?>></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <!--FAVICON-->
    <link rel="icon" type="image/ico" href=<?php echo __DIR__ . "/../media/images/favicon.ico"; ?>>

    <!--MULTIIDIOMA-->
    <link rel="stylesheet" href=<?php echo __DIR__ . "/../core/language/css/language.css"; ?>>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['idioma'] = "GALEGO";
    include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
</head>
<body>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	
</body>

</html>