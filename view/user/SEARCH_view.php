<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

    $userMapper = new UserMapper();
    $profileMapper = new ProfileMapper();
?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["USER"] ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=user&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                
                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info pull-right" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                                                 
                    </div>
                    <div class="col-xs-12  col-md-5 pull-left">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="username" name="username" placeholder="<?php echo $strings['name'];?>" >
                        </div>
                    </div>
                        <!--Campo name-->
                </div>

                <div class="row">
                    <div class="col-xs-10 col-md-6 pull-right">
                                 <label for="selectperf"><?php echo $strings['profile_type']; ?></label>
                        <div id="selectperf" class="form-group">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <?php echo $strings['use_q'] ?>
                                </span>
                                <span  class="input-group-addon">
                                    <input id="usepf" name="usepf" type="checkbox">
                                </span>
                                
                                <select id='id_perfil' name='id_perfil' class='form-control icon-menu'
                                        onchange='enviar()'>
                                    <?php
                                    //Engadimos unha opcion por perfil que se pode escoller
                                        $pc = new ProfileMapper();

                                        echo "<option value='NULL'>".$strings['no_profile']."</option>
                                        ";

                                        //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                        $profiles = $pc->show();
                                    
                                        foreach ($profiles as $profile) {

                                            echo "<option value='" . $profile->getCodprofile()."'";
                                            echo ">" . $profile->getProfilename() . "</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12  col-md-5 pull-left">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="coduser" name="coduser" placeholder="<?php echo $strings['code'];?>" >
                        </div>
                    </div>
                        <!--Campo name-->
                </div>
                

                <div class="row">
                
                    
                </div>


                

            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=user&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-search"></i>
                        <?php echo $strings['find'] ?></i></button>
                    <?php

                    ?>
                </div>
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