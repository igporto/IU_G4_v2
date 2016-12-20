<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../model/USER_model.php");
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
<div class="col-xs-12 col-md-8 col-md-offset-2" style="margin-top: 20px">

    <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
        <thead>
        <tr class="row" >
            <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
            <th class="text-center"><?php echo $strings['USER']?></th>
            <th class="text-center"><?php echo $strings['ACTION']?></th>
        </tr>
        </thead>

        <tbody>
        <!--CADA UN DE ESTES É UNHA FILA-->

        <?php
        $uc = new UserController();
        $um = new UserMapper();
        //Recollemos os usuarios
        $users = $um->show();
        $permissions = $uc->getCurrentUserPerms();

        $delete = false;
        $edit = false;
        $view = false;
        //Comprobamos os permisos que ten o usuario actual
        foreach ($permissions as $perm){

            if($perm->getAction()->getActionname() == "EDIT"){
                $edit = true;
            }
            if($perm->getAction()->getActionname() == "DELETE"){
                $delete = true;
            }
            if($perm->getAction()->getActionname()== "VIEW"){
                $view = true;
            }
        }

        //Para cada usuario, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
        foreach ($users as $u) {
            echo "<tr class='row text-center' ><td> ";

            echo $u->getUsername()."</td><td class='text-center'>";
            //Botón que direcciona a vista do usuario
            if($view){
                echo "<a href='index.php?controller=USER&action=VIEW&user=" .
                    $u->getUsername() . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-eye fa-fw'></i></button></a>";
            }
            //Botón que direcciona á vista do editar
            if($edit){
                if($u->getUsername()!=$_SESSION['currentuser'] && $u->getUsername()!='admin'){
                    echo "<a href='index.php?controller=user&action=edit&user=" . $u->getUsername() . "'>";
                }else{
                    echo "<a href='#'>";
                }

                echo "<button class='btn btn-warning btn-xs ";

                if($u->getUsername() == $_SESSION["currentuser"]){
                    echo " disabled' data-toggle='tooltip' title='".$strings['cannot_modify_user'];
                }
                echo "' style='margin:2px'>";


                echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                /*echo "<a href='index.php?controller=user&action=edit&user=" .
                    $u["user"] . "'><button class='btn btn-warning btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-edit fa-fw'></i></button></a>";*/
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
                                            <h4 class="modal-title" id="'.$u->getUsername().'label">'.$strings["DELETE"].': '.$u->getUsername().'</h4>
                                        </div>
                                        <div class="modal-body">
                                            '.$strings["confirm_message"].' '.$u->getUsername().'? 
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


