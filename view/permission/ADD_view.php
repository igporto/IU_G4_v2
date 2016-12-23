<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>

<script>
    function enviar() {
        var ruta = 'index.php?controller=permission&action=add&controller_id=';
        var nome = document.getElementById("controller_id").value;
        
        window.location.href = ruta.concat(nome);
    }
</script>
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px">
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=permission&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <label><?php echo $strings['CONTROLLER'] ?></label></div>
                <select id='controller_id' name='controller_id' class='form-control icon-menu'
                        onchange='enviar()'>
                    <?php
                    //Engadimos unha opcion por controlador que se pode escoller
                    $cm = new ControllerMapper();


                    //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                    $controllers = $cm->show();
                    foreach ($controllers as $controller) {
                        if(isset($_REQUEST["controller_id"]) && $controller->getCodcontroller == $_REQUEST["controller_id"] ){
                            echo "<option value=" . $controller->getCodcontroller()." selected >" . $controller->getControllername() . "</option>";
                        }else{
                            echo "<option value=" . $controller->getCodcontroller().">" . $controller->getControllername() . "</option>";
                        }
                    }
                    ?>
                </select>
                <?php
                echo "<div>
                        <div>
                            <label>".$strings['PERMISSION']."</label>:
                        </div>
                      <div>";
               
                $am = new ActionMapper();
                $pm = new PermissionMapper();
                $actions = $am->show();
                $permissions = $pm->show();

                if(isset($_REQUEST["controller_id"]) && $_REQUEST["controller_id"] != "NULL") {
                    //Creamos un obxctto Controller co id que recibimos po $_GET que é do que temos que mostrar os datos
                    $c = $cm->view($_REQUEST["controller_id"]);
                    echo "<div class='col-md-6 col-md-offset-3'>";

                    echo "<div class='text-center'><label>" . $c->getControllername() . "</label></div>";
                    foreach ($actions as $a) {
                        //Creamos un obxecto Permission co controlador e accion actual para poder comprobar que xa hai un permiso con ese par
                        //CONTROLLER -> ACTION
                        $permissionaux = new Permission(NULL, $c, $a);
                        //Se xa existe ese permiso mostramolo pero non o deixamos engadir ese par CONTROLLER -> ACTION
                        if ($pm->permissionExists($permissionaux)) {
                            echo "<input type='checkbox' name='' value='' checked disabled >" . $a->getActionname() . "</input>";
                        } else {
                            echo "<input type='checkbox' name='action_id' value='" . $a->getCodAction() . "'>" . $a->getActionname() . "</input>";
                        }

                    }
                }
                ?>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px" class="col-md-6 col-md-offset-3">

            <button class="btn btn-primary btn-md btn-block" id="submit" name="submit" type="submit">
                <?php echo $strings['create_permission'] ?></i></button>
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
            ?>
            <button class="btn btn-outline btn-warning btn-md btn-block" name="reset" type="reset">
                <?php echo $strings['clean'] ?></i></button>
        </div>
    </form>
    <!--fin formulario-->
</div>

<script>
    function validar() {
        $permission = document.getElementById("permission").getAttribute().valueOf();
        alert($permission);
        return false;
    }

    //validacion de espazos en branco en cadeas para engadir permisos
    function hasWhiteSpace() {
        //print();
        var x = document.form;
        var s = x.permission.value;
        var w = <?php echo json_encode($strings); ?>;
        //document.write(s);
        if (s.indexOf(' ') >= 0) {
            window.alert(w['white']);
            return false;
        } else {
            return true;
        }
    }

</script>