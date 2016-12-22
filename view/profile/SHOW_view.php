<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");

require_once(__DIR__ . "/../../controller/PROFILE_controller.php");
require_once(__DIR__ . "/../../model/PROFILE_model.php");
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
            <th class="text-center"><?php echo $strings['PROFILE']?></th>
            <th class="text-center"><?php echo $strings['ACTION']?></th>
        </tr>
        </thead>

        <tbody>
        <!--CADA UN DE ESTES É UNHA FILA-->

        <?php
        $uc = new UserController();
        $um = new ProfileMapper();
        //Recollemos os usuarios
        $profiles = $um->show();
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
        foreach ($profiles as $p) {
            echo "<tr class='row text-center' ><td> ";

            echo $p->getProfilename()."</td><td class='text-center'>";
            //Botón que direcciona a vista do usuario
            if($view){
                echo "<a href='index.php?controller=PROFILE&action=VIEW&profile_id=" .
                    $p->getCodprofile() . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-eye fa-fw'></i></button></a>";
            }
            //Botón que direcciona á vista do editar
            if($edit){

                echo "<a href=index.php?controller=profile&action=edit&profile_id=". $p->getProfilename().'>';
                echo "<button class='btn btn-warning btn-xs ";
                echo "' style='margin:2px'>";
                echo "<i class='fa fa-edit fa-fw'></i></button></a>";

            }
            //Botón que direcciona á vista de eliminar
            if($delete){
                echo '<button type="button" class="btn btn-danger btn-xs';
                echo '" data-toggle="modal" data-target="#confirmar'.$p->getProfilename().'">';

                echo '<i class="fa fa-trash-o fa-fw"></i>
                </button>';

            }

            //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA USUARIO
            echo '
            <div class="modal fade" id="confirmar'.$p->getProfilename().'" tabindex="-1" role="dialog" aria-labelledby="'.$p->getProfilename().'label" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="'.$p->getProfilename().'label">'.$strings["confirm_message"].' '.$p->getProfilename().'?</h4>
                                        </div>
                                        <div class="modal-body">
                                             <label for="">' . $strings["controller_data"] . ': </label>';
            //DATOS DO USUARIO A BORRAR
            echo '  
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                    <label for="">' . $strings["name"] . ': </label>
                                                    <span class="">' . $p->getProfilename() . '</span>

                                                <!--Campo ususario-->
                                            </div></div></div><div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                                            
                                            <a href="index.php?controller=controller&action=delete&controller_id=' . $p->getProfilename().'">
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

