<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
switch ($_SESSION['idioma']) {
    case 'SPANISH':
        include 'js/showscriptES.js';
        break;
    case 'GALEGO':
        include 'js/showscriptGL.js';
        break;
    case 'ENGLISH':
        include 'js/showscriptEN.js';
        break;
    default:
        include 'js/showscriptGL.js';
        break;
}

?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px" >
    <form name="form" id="form" method="POST" enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['user_info'] ?>
            </div>
            <div class="panel-body">

                <?php $um = new UserMapper();
                    $id_user = $um->getIdByName($_REQUEST["user"]);
                ?>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                            <label for=""><?php echo $strings['name'];?>: </label>
                            <span class=""><?php echo $um->view($id_user)->getUsername();?></span>

                        <!--Campo ususario-->
                    </div>

                    <div class="col-xs-12 col-md-12">
                            <label for=""><?php echo $strings['profile_type']; ?>: </label>
                            <span class=""><?php echo $um->view($id_user)->getProfile()->getProfilename(); ?></span>
                        <!--Campo perfil-->
                    </div>


                    <div class="col-xs-12 col-md-12">
                            <label for=""><?php echo $strings['own_permis'].":";?></label>
                            <ul>
                                <?php

                                    $permissions = $um->view($id_user)->getPermissions()->getUserPermissions();

                                   if($permissions != NULL){
                                       //foreach que imprime o nome do controlador e da acción según os permisos que ten o usuario
                                       foreach ($permissions as $p){
                                           echo '<li><span class=\"\">'.$p->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                           echo '<span class=\"\">'.$p->getAction()->getActionname().'</span></li>';
                                       }
                                   }
                                    else{
                                        echo $strings['no_user_permissions'];
                                    }
                                    
                                ?>
                            </ul>

                    </div>

                </div>
            </div>
        </div>
    </form>
    <!--fin formulario-->
</div>