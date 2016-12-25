<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");
require_once(__DIR__ . "/../../model/CONTROLLER_model.php");
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


    $uc = new UserController();
    $um = new ControllerMapper();
    //Recollemos os usuarios
    $controllers = $um->show();
    $permissions = $uc->getCurrentUserPerms();

    $add = false;
    $delete = false;
    $edit = false;
    $view = false;
    //Comprobamos os permisos que ten o usuario actual
    foreach ($permissions as $perm){
    
        if($perm->getController()->getControllername() == $_GET["controller"]){
            if($perm->getAction()->getActionname()== "ADD"){
                $add = true;
            }
            elseif($perm->getAction()->getActionname() == "EDIT"){
                $edit = true;
            }
            elseif($perm->getAction()->getActionname() == "DELETE"){
                $delete = true;
            }
            elseif($perm->getAction()->getActionname()== "VIEW"){
                $view = true;
            }
        }
    }

?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-xs-12 col-md-8 " style="margin-top: 20px">
<h1 class="page-header"><?php echo $strings['management_controllers'] ?></h1>

            <div class="row">
                    <!--BOTÓN BUSCAR-->
                    <div class="col-xs-4 col-md-2">
                        <button type="button" class="btn btn-primary">
                        <i class="fa fa-fw fa-search"></i>
                        <?php echo $strings['find']; ?></button>
                    </div>
                    
                    <!--BOTÓN ENGADIR-->
                    <?php if ($add) {
                        echo '  <div class="col-xs-4 col-md-2">
                                    <a href="index.php?controller=controller&action=add">
                                        <button type="button" class="btn btn-primary">
                                        <i class="fa fa-fw fa-plus"></i>
                                            '. $strings['ADD'].'
                                        </button>
                                    </a>
                                </div>';
                    } ?>
            </div>

            <!--PANEL TABOA DE LISTADO-->
            <div class="row" style="margin-top: 20px">
            <div class="panel panel-default">
                <div class="panel-heading">
                            <?php echo $strings['list_of'].' '.$strings['CONTROLLER']; ?>
                        </div>
                        <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row" >
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['CONTROLLER']?></th>
                        <?php
                        if(!$add && !$edit && !$delete && !$view){ ?>
                            <th class="text-center"><?php echo $strings['no_actions_to_do']?></th>
                            <?php
                        }else{
                            ?>
                            <th class="text-center"><?php echo $strings['ACTION']?></th>
                        <?php } ?>
                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    

                    <?php

                    //Para cada usuario, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($controllers as $c) {
                        echo "<tr class='row text-center' ><td> ";

                        echo $c->getControllername()."</td><td class='text-center'>";
                        //Botón que direcciona a vista do usuario
                        if($view){
                            echo "<a href='index.php?controller=CONTROLLER&action=VIEW&controller_id=" .
                                $c->getControllername() . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                            echo "<i class='fa fa-eye fa-fw'></i></button></a>";
                        }
                        //Botón que direcciona á vista do editar
                        if($edit){

                            echo "<a href=index.php?controller=controller&action=edit&controller_id=". $c->getControllername().'>';
                            echo "<button class='btn btn-warning btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                        }
                        //Botón que direcciona á vista de eliminar
                        if($delete){
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar'.$c->getControllername().'">';
                            
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                            </button>';
                            
                        }

                        //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA USUARIO
                        echo '
                        <div class="modal fade" id="confirmar'.$c->getControllername().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getControllername().'label" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="'.$c->getControllername().'label">'.$strings["confirm_message"].' '.$c->getControllername().'?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                         <label for="">' . $strings["controller_data"] . ': </label>';
                                                    //DATOS DO USUARIO A BORRAR
                                                   echo '  
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                                <label for="">' . $strings["name"] . ': </label>
                                                                <span class="">' . $c->getControllername() . '</span>

                                                            <!--Campo ususario-->
                                                        </div></div></div><div class="modal-footer">
                                                        
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                                                        
                                                        <a href="index.php?controller=controller&action=delete&controller_id=' . $c->getControllername().'">
                                                        <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>';
                        echo "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div><!-- fin panel -->
   
                </div><!-- fin row -->
</div>


