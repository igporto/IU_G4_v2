<?php require_once(__DIR__."/../../core/ViewManager.php"); 
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");?>

 
<div class="login-form">
    <h1><img src="media/images/Logo_Moovett.png" class="imgLogo"></h1>

    <form name="login" action="index.php?controller=user&action=login" method="post"
          onsubmit=" return validateForm();">

        <!-- Campo del usuario -->
        <div class="form-group " on>
            <input type="text" class="form-control" placeholder="Usuario " id="userName"
                   onfocus="hideError();selUsr();" onblur="hideError();" name="userName">
            <i class="fa fa-user" id="usrImg"></i>
        </div>

        <!-- Campo de la contraseña -->
        <div class="form-group log-status">
            <input type="password" class="form-control" placeholder="Contrasinal" id="password"
                   onfocus="hideError();selPass();" onblur="hideError();" name="password">
            <i class="fa fa-lock" id="lock"></i>
        </div>
        
        <span class="alert" style="display: inherit;"><?= isset($errors['userNotValid'])?$errors['userNotValid']:'';?></span>                     

        <input type="submit" class="log-btn" value="Login" name="login"/>

        <span class="alert" id="emptyErr">O campo debe estar cuberto.</span>
    </form>
</div>



     

            






