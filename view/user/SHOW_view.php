<!--SCRIPT DE DATATABLE-->
<?php
require_once('controllers/USER_controller.php');
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
unset($_SESSION["cambiado"]);

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
        $uc = new USER_controller();
        //Recollemos os usuarios e os permisos
        $usuarios = $uc->getUsers();
        $permisos = $uc->getPermissions($_REQUEST['controller']);

        $delete = false;
        $edit = false;
        $view = false;
        //Comprobamos os permisos que ten
        foreach ($permisos as $p){

            //echo $p;
            if($p == "EDIT"){
                $edit = true;
            }
            if($p == "DELETE"){
                $delete = true;
            }
            if($p == "VIEW"){
                $view = true;
            }
        }
        //Para cada usuario, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
        foreach ($usuarios as $u) {
            echo "<tr class='row text-center' ><td> ";

            echo $u["user"]."</td><td class='text-center'>";
            //Botón que direcciona a vista do usuario
            if($view){
                echo "<a href='index.php?controller=user&action=view&user=" .
                    $u["user"] . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-eye fa-fw'></i></button></a>";
            }
            //Botón que direcciona á vista do editar
            if($edit){ 
                if($u["user"]!=$_SESSION['currentuser'] && $u["user"]!='admin'){
                    echo "<a href='index.php?controller=user&action=edit&user=" . $u["user"] . "'>";
                }else{
                    echo "<a href='#'>";
                }

                echo "<button class='btn btn-warning btn-xs ";

                if($u["user"]=='admin'){
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
                if($u["user"]!=$_SESSION['currentuser'] && $u["user"]!='admin' ){
                    echo "<a href='index.php?controller=user&action=delete&user=" . $u["user"] . "'>";
                }else{
                    echo "<a href='#'>";
                }

                echo "<button class='btn btn-danger btn-xs";

                if($u["user"]==$_SESSION['currentuser']  || $u["user"]=='admin' ){
                    echo " disabled' data-toggle='tooltip' title='".$strings['cannot_delete_user'];
                }
                    echo "' style='margin:2px'>";
                
                
                echo "<i class='fa fa-trash-o fa-fw'></i></button></a>";
            }
           

            echo "</td></tr>";
        }
        ?>
        </tbody>
    </table>

</div>


