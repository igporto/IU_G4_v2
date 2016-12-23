<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px">
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=permission&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="permission" name="permissionname"
                                   placeholder= <?php echo $strings['name'] ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo ususario-->
                    </div>
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