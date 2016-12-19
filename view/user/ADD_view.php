
<!-- CONTIDO DA PAXINA -->
<?php 
    require_once(__DIR__ . "/../../core/ViewManager.php");
    $view = ViewManager::getInstance();
    include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
    
?>
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px" >
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()" action="index.php?controller=user&action=add"
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
                            <input type="text" class="form-control" id="user" name="user" placeholder= <?php echo $strings['username'] ?>
                            required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo ususario-->

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="password" name="password"
                                   placeholder= <?php echo $strings['pass'] ?> required="true">
                        </div>
                        <!--Campo password-->
                    </div>


                    <div class="col-xs-12 col-md-6 col-md-offset-6">
                        <label for=""><?php echo $strings['profile']; ?>:</label>
                        <div class="form-group">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></span>
                                <select id='perf_id' name='perf_id' class='form-control icon-menu'>
                                    <?php
                                    
                                    foreach ($profiles as $key => $v) {
                                        echo "<option value='" . $v["perf_id"] . "'>" . $v["name"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <!--Campo dos perfiles de usuario-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px" class="col-md-6 col-md-offset-3">

            <button class="btn btn-primary btn-md btn-block" id="submit" name="submit" type="submit">
                <?php echo $strings['create_user'] ?></i></button>
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
        $user = document.getElementById("user").getAttribute().valueOf();
        alert($user);
        return false;
    }

    //validacion de espazos en branco en cadeas para engadir usuarios
    function hasWhiteSpace() {
        //print();
        var x = document.form;
        var s = x.user.value;
        var w = <?php echo json_encode($strings); ?>;
        //document.write(s);
        if(s.indexOf(' ') >= 0){
            window.alert(w['white']);
            return false;
        }else{
            return true;
        }
    }

</script>