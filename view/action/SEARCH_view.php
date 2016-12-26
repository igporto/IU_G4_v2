<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>



<div class="col-md-6 " style="margin-top: 20px">
<h1 class="page-header"><?php echo $strings['search'].' '.$strings['ACTION'] ; ?></h1>
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=action&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input type="text" class="form-control" id="codaction" name="codaction"
                                   placeholder= <?php echo $strings['codaction'] ?>>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <!--Campo action-->
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="actioname" name="actionname"
                                   placeholder= <?php echo $strings['name'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
    
            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=action&action=show">
                    <i class="fa fa-arrow-left"></i>
                    <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                    <?php echo $strings['clean'] ?></i></button>

                <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                    <i class="fa fa-search"></i>
                    <?php echo $strings['search'] ?></i></button>
                <?php
                
                ?>
                </div>
            </div>
                
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