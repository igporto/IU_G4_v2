<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

    $profilemapper = new ProfileMapper();
    //Recuperamos o id do usuario a editar
    $profile_id = $_REQUEST["profile_id"];
    $currentProfile = $profilemapper->view($profile_id);

?>

<div class="col-md-12" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['profile_modify'].": ".$currentProfile->getProfilename() ; ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=profile&action=edit&profile_id=<?php echo $profile_id;?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                
                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                        <!--  <div class="row">
                            <?php echo $strings['max_length'] ?>: 25
                        </div>-->
                         
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="newname" name="newname"
                                   value="<?php echo $currentProfile->getProfilename()?>"
                                   maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                </div>

                <!-- checks dos permisos -->
                <label for="well"><?php echo $strings["PERMISSION"].":"; ?></label>
                <div id="well" class="well">
                <div class="row">
                    

                        
                        
                    
                        <?php    
                        //PERMISOS PROPIOS DO PERFIL
                        //recorremos os permisos do perfil(so se mostran xa que non se poden modificar)
                        $pm = new PermissionMapper();
                        $allperms = $pm->show();
                        $profileperms = $currentProfile->getPermissions();

                        if ($profileperms != NULL) {
                                   //axuda
                                $currentControllername = $allperms[0]->getController()->getControllername();

                                //divisor + etiqueta para cada grupo
                                echo '<div class="col-xs-12 col-sm-6 col-md-4">';
                                echo "<div><label>".$currentControllername."</label></div>";

                                //form-group de checks
                                echo '<div class="form-group">';
                                foreach ($allperms as $p) {

                                    //recuperamos os nomes do controlador  e accion do perfile a mostrar
                                    $controllername = $p->getController()->getControllername();
                                    $actionname = $p->getAction()->getActionname();

                                    if($controllername != $currentControllername){
                                        
                                        $currentControllername = $controllername;
                                        //divisor + etiqueta para cada grupo
                                        echo "</div>"; //pechar o contedor
                                        echo "</div>"; //pechar o form-group anterior
                                        echo '<div class="col-xs-12 col-sm-6 col-md-4">';
                                        echo "<div ><label>".$currentControllername. "</label></div>";

                                        //form-group de checks
                                        echo '<div class="form-group">';
                                    
                                    }
                                       
                                    echo "<div class='checkbox'><label><input type='checkbox' name='profileperm[]' value='".$p->getCodpermission()."'";



                                    //marcar o permiso se xa o ten o perfil
                                    if (in_array($p, $profileperms)) {
                                        echo "checked";
                                    }

                                    echo ">".$actionname."</label></div>
                                    "; 
                                    
                                    
                                    
                                    
                                       
                        }
                        }else{
                                    //axuda
                                $currentControllername = $allperms[0]->getController()->getControllername();

                                //divisor + etiqueta para cada grupo
                                echo '<div class="col-xs-12 col-sm-6 col-md-4">';
                                echo "<div><label>".$currentControllername. "</label></div>";

                                //form-group de checks
                                echo '<div class="form-group">';
                                foreach ($allperms as $p) {

                                    //recuperamos os nomes do controlador  e accion do perfile a mostrar
                                    $controllername = $p->getController()->getControllername();
                                    $actionname = $p->getAction()->getActionname();

                                    if($controllername != $currentControllername){
                                        
                                        $currentControllername = $controllername;
                                        //divisor + etiqueta para cada grupo
                                        echo "</div>"; //pechar o contedor
                                        echo "</div>"; //pechar o form-group anterior
                                        echo '<div class="col-xs-12 col-sm-6 col-md-4">';
                                        echo "<div ><label>".$currentControllername. "</label></div>";

                                        //form-group de checks
                                        echo '<div class="form-group">';
                                    }
                                    
                                        echo "<div class='checkbox'><label><input type='checkbox' name='profileperm[]' value='".$p->getCodpermission()."'>".$actionname."</label></div>
                                    "; 
                                    
                                       
                                }
                        }
                        
                        //fin de form-group e container
                        echo '</div></div>';
                ?>
                        
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=profile&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-edit"></i>
                        <?php echo $strings['EDIT'] ?></i></button>
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