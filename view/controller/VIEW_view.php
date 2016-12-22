<!-- CONTIDO DA PAXINA -->

<?php
    require_once(__DIR__ . "/../../controller/USER_controller.php");
    require_once(__DIR__ . "/../../model/PERMISSION_model.php");
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


<div class="col-md-6 col-md-offset-3" style="margin-top: 20px">
    
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['controller_data']  ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">                      
                            <label><?php echo $strings['name'] ?>: </label>  <?php echo $_GET["controller_id"] ?>
                    </div>
                </div>

               
        </div>
    <!--fin formulario-->
</div>
