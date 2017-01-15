<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>INSTALACION DE MOOVETT</title>

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

<div class="login-form">
    <h1 style="text-align: center">LOGIN DE INSTALACIÓN</h1>
    <h3 style="text-align: center"> Introduce o usuario para que sexa administrador na aplicación</h3>

    <form name="login" action="install.php" method="post"
          onsubmit=" return validateForm()">

        <!-- Campo del usuario -->
        <div class="form-group ">
            <input type="text" class="form-control" placeholder="Usuario"  name="u">
            <i class="fa fa-user" id="usrImg"></i>
        </div>

        <!-- Campo de la contraseña -->
        <div class="form-group log-status">
            <input type="password" class="form-control" placeholder="Contrasinal" name="p">
            <i class="fa fa-lock" id="lock"></i>
        </div>

        <input type="submit" class="log-btn" value="Login" name="login"/>

        <span class="alert" id="emptyErr"><?php echo $strings['empty_error']; ?></span>
    </form>
</div>

</body>

</html>

