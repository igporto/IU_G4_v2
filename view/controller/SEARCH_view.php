<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>

<h1 class="page-header"><?php echo $strings['search']; ?></h1>

<div class="col-md-6 " style="margin-top: 20px">
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=controller&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['search'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="codcontroller" name="codcontroller"
                                   placeholder= <?php echo $strings['codaction'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="controllername" name="controllername"
                                   placeholder= <?php echo $strings['name'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px" class="col-md-6 col-md-offset-3">

            <button class="btn btn-primary btn-md btn-block" id="submit" name="submit" type="submit">
                <?php echo $strings['search'] ?></i></button>
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

    //validacion de espazos en branco en cadeas para engadir usuarios
    function hasWhiteSpace() {
        //print();
        var x = document.form;
        var s = x.user.value;
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