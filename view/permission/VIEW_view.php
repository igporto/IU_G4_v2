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
    $pm = new ProfileMapper();
?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px" >
    <form name="form" id="form" method="POST" enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['profile_info'] ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                            <label for=""><?php echo $strings['name'];?>: </label>
                            <span class=""><?php echo $pm->view($_REQUEST["profile_id"])->getProfilename();?></span>

                        <!--Campo nome do perfil-->
                    </div>

                    <div class="col-xs-12 col-md-12">
                            <label for=""><?php echo $strings['PERMISSION'].":";?></label>
                            <ul>
                                <?php

                                    $permissions = $pm->view($_REQUEST["profile_id"])->getPermissions();

                                   if($permissions != NULL){
                                       //foreach que imprime o nome do controlador e da acción según os permisos que ten o usuario
                                       foreach ($permissions as $p){
                                           echo '<li><span class=\"\">'.$p->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                           echo '<span class=\"\">'.$p->getAction()->getActionname().'</span></li>';
                                       }
                                   }
                                    else{
                                        echo $strings['no_profile_permissions'];
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