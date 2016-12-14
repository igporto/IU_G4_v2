<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Moovett</title>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['idioma'] = "GALEGO";
    include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>

    <!--BOOTSTRAP-->
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/bootstrap/js//bootstrap.min.js"></script>
    <!--LINK DE CARGA DE BOOTSTRAP-->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel='stylesheet prefetch'
          href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <!--LOGIN STYLESHEET-->
    <link rel="stylesheet" href="css/loginStyle.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


     <!-- Custom CSS -->
    <link href="lib/admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
    <script src="lib/admin/js/sb-admin-2.js"></script>

    <script src="js/loginValidations.js"></script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <!--FAVICON-->
    <link rel="icon" type="image/ico" href=<?php echo __DIR__ . "/../media/images/favicon.ico"; ?>>

    <!--MULTIIDIOMA-->
    <link rel="stylesheet" href=<?php echo __DIR__ . "/../../core/language/css/language.css"; ?>>
</head>
<body>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>

</body>

</html>