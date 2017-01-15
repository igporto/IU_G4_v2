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

<div class="col-md-12">

<h1 class="page-header"><?php echo $strings['create_permission']?></h1>


    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=permission&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <div class="form-group"><!-- div1 -->
                    <label><?php echo $strings['CONTROLLER'] ?>: </label>
                    <select id='controller_id' name='controller_id' class='form-control' onchange='enviar()'>
                    <?php
                    //Engadimos unha opcion por controlador que se pode escoller
                    $cm = new ControllerMapper();


                    //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                    $controllers = $cm->show();

                    echo "<option value=NULL>".$strings["no_controller"]."</option>
                    ";
                    foreach ($controllers as $controller) {
                        if(isset($_REQUEST["controller_id"]) && $controller->getCodcontroller() == $_REQUEST["controller_id"] ){
                            echo "<option value=" . $controller->getCodcontroller()." selected >" . $controller->getControllername() . "</option>
                            ";
                        }else{
                            echo "<option value=" . $controller->getCodcontroller().">" . $controller->getControllername() . "</option>
                            ";
                        }
                    }
                    ?>
                </select>

                </div><!-- cerrar div1 -->
    
                    <label for="well"><?php echo $strings['PERMISSION']?>: </label>
                    <div id="well" class="well">
                        <div class="row" style="padding: 5px"><!-- div2 -->
                            <?php

                            $am = new ActionMapper();
                            $pm = new PermissionMapper();
                            $actions = $am->show();
                            $permissions = $pm->show();

                            if(isset($_REQUEST["controller_id"]) && $_REQUEST["controller_id"] != "NULL") {

                                //Creamos un obxctto Controller co id que recibimos po $_GET que é do que temos que mostrar os datos
                                $c = $cm->view($_REQUEST["controller_id"]);
                                echo "<div class='form-group'>";

                                foreach ($actions as $a) {
                                    //Creamos un obxecto Permission co controlador e accion actual para poder comprobar que xa hai un permiso con ese par
                                    //CONTROLLER -> ACTION
                                    $permissionaux = new Permission(NULL, $c, $a);
                                    //Se xa existe ese permiso mostramolo pero non o deixamos engadir ese par CONTROLLER -> ACTION
                                    if ($pm->permissionExists($permissionaux)) {
                                        echo "<div class='checkbox'><label><input type='checkbox' name='' value='' checked disabled >" . $a->getActionname() . "</label></div>
                                        ";
                                    } else {
                                        echo "<div class='checkbox'><label><input type='checkbox' name='actions[]' value='" . $a->getCodAction() . "'>" . $a->getActionname() . "</label></div>
                                        ";
                                    }
                                }
                                echo  '</div><!-- /form-group -->';
                            }
                            ?>
                        </div><!-- /div2 -->
                    </div><!-- well -->
                </div><!-- /panel-body -->
            </div><!-- /panel -->
            <div class="row">
    
                <div class="col-xs-12">
                    <div class="pull-left">
                        <a class="btn btn-default btn-md" href="index.php?controller=permission&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                    </div>

                    <div class="pull-right">
                        <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-plus"></i>
                        <?php echo $strings['ADD'] ?></i></button>
                    <?php
                    
                    ?>
                </div>
            </div>        
    </form>
    <!--fin formulario-->
</div>

<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>