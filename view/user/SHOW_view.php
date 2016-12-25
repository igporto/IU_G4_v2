<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../model/USER_model.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

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
    $um = new UserMapper();


    //Recollemos os usuarios
    $users = $view->getVariable("userstoshow");
    $permissions = $uc->getCurrentUserPerms();

    $add = false;
    $delete = false;
    $edit = false;
    $v = false;

    //Comprobamos os permisos que ten o usuario actual
    foreach ($permissions as $perm){

        if($perm->getController()->getControllername() == strtoupper($_GET["controller"])){
            $action = $perm->getAction()->getActionname();
            if($action == "ADD"){
                $add = true;
            }
            elseif($action == "EDIT"){
                $edit = true;
            }
            elseif($action == "DELETE"){
                $delete = true;
            }
            elseif($action== "VIEW"){
                $v = true;
            }
        }
    }

                                
?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-xs-12 col-md-8 " style="margin-top: 20px">

<h1 class="page-header"><?php echo $strings['management_users'] ?></h1>

<div class="row">

        <!--BOTÓN BUSCAR-->
        <div class="col-xs-4 col-md-2">
            <a href="index.php?controller=user&action=search">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-fw fa-search"></i>
                    <?php echo $strings['find']; ?>
                </button>
            </a>
        </div>


        <!--BOTÓN ENGADIR-->
        <?php if ($add) {
            echo '  <div class="col-xs-4 col-md-2">
                        <a href="index.php?controller=user&action=add">
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
                            <?php echo $strings['list_of'].' '.$strings['ACTION']; ?>

                        </div>
                        <div class="panel-body">
    <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
        <thead>
        <tr class="row" >
            <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
            <th class="text-center"><?php echo $strings['USER']?></th>
            <?php
            if(!$edit && !$delete && !$v){ ?>
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
        foreach ($users as $u) {
            echo "<tr class='row text-center' ><td> ";

            echo $u->getUsername()."</td><td class='text-center'>";
            //Botón que direcciona a vista do usuario
            if($v){
                echo "<a href='index.php?controller=USER&action=VIEW&user=" .
                    $u->getUsername() . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-eye fa-fw'></i></button></a>";
            }
            //Botón que direcciona á vista do editar
            if($edit){

                echo "<a href=index.php?controller=user&action=edit&user=". $u->getUsername().'>';
                echo "<button class='btn btn-warning btn-xs ";
                echo "' style='margin:2px'>";

                echo "<i class='fa fa-edit fa-fw'></i></button></a>";

            }
            //Botón que direcciona á vista de eliminar
            if($delete){
                echo '<button type="button" class="btn btn-danger btn-xs';
                    if($u->getUsername()==$_SESSION['currentuser']){
                        echo ' disabled">';
                    }else{
                        echo '" data-toggle="modal" data-target="#confirmar'.$u->getUsername().'">';
                    }
                
                echo '<i class="fa fa-trash-o fa-fw"></i>
                </button>';
                
            }

            //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA USUARIO
            echo '
            <div class="modal fade" id="confirmar'.$u->getUsername().'" tabindex="-1" role="dialog" aria-labelledby="'.$u->getUsername().'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="'.$u->getUsername().'label">'.$strings["confirm_message"].' '.$u->getUsername().'?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["user_data"] . ': </label>';
                        //DATOS DO USUARIO A BORRAR
                       echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["name"] . ': </label>
                                    <span class="">' . $u->getUsername() . '</span>
        
                                <!--Campo ususario-->
                            </div>
        
                            <div class="col-xs-12 col-md-12">
                                    <label for="">'.$strings["profile_type"].': </label>
                                    <span class="">'.$u->getProfile()->getProfilename().'</span>
                                <!--Campo perfil-->
                            </div>
        
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $u->getUsername() . '" aria-expanded="true" class="">'.$strings["own_permis"].': </a>
                                            </h4>
                                        </div>
                                        <div id="collapse' . $u->getUsername() . '" class="panel-collapse collapse" aria-expanded="true">
                                            <div class="panel-body">
                                <ul>';
                                        
                                $permissions = $u->getPermissions()->getUserPermissions();
                                
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
                        echo '</ul>
    
                    </div>
                </div>
            </div>

                            </div>

                        </div>';

                        //fin dos datos do usuario
                        echo '
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                            
                            <a href="index.php?controller=user&action=delete&user=' . $u->getUsername().'">
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
    </div>
    </div>
</div>


