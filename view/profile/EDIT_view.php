<!-- CONTIDO DA PAXINA -->

<?php
    require_once(__DIR__ . "/../../controller/PROFILE_controller.php");
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
    $profilemapper = new ProfileMapper();
    //Recuperamos o id do usuario a editar
    $profile_id = $_REQUEST["profile_id"];
    $currentProfile = $profilemapper->view($profile_id);

?>
<script>
    function enviar() {
        var ruta = 'index.php?controller=user&action=edit&user=';
        var nome = <?php echo '"'.$username.'"';?>;
        var query = '&perf_id=';
        var perfil = document.getElementById("perf_id").value;

        var parte1 = ruta.concat(nome);
        var parte2 = query.concat(perfil);
        window.location.href = parte1.concat(parte2);
    }
</script>

<div class="col-md-8 col-md-offset-2" style="margin-top: 20px">
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=profile&action=edit&profile_id=<?php echo $profile_id; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['user_modify'] . " " . $currentProfile->getProfilename() ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="text" name="newname"
                                   placeholder=<?php echo $strings['newname'];?> >
                        </div>
                        <!--Campo nome-->
                    </div>
                </div>

                <?php
                    //IMPRESIÓN DOS PERMISOS DO PERFIL
                    echo "<div>
                              <div>
                                    <label>".$strings['profile_perms']."</label>: 
                              </div>
                          <div><p class='help-block'>".$strings['not_edit_perm']."</div>";

                    $permissionmapper = new PermissionMapper();
                    $allpermissions = $permissionmapper->show();
                    $profileperms = $currentProfile->getPermissions();

                    //Comprobamos que ten permisos para mostrar
                    if($profileperms != NULL){
                        echo "<div>
                            <label>".$strings['profile_perms']."</label>: 
                          </div>";

                        //Seteamos de novo o Controlador do permiso actual
                        $currentControllername = $profileperms[0]->getController()->getControllername();
                        echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                        foreach ($allpermissions as $ap) {

                            //recuperamos os nomes do controlador  e accion do perfile a mostrar
                            $controllername = $ap->getController()->getControllername();
                            $actionname = $ap->getAction()->getActionname();
                            if($controllername != $currentControllername){
                                // echo "</div>";
                                $currentControllername = $controllername;
                                echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                            }
                            //Se ten ese permiso pomolo marcado
                            if(in_array($ap, $userperms)){
                                //$perm_id = $actionname . "_" . $controllername;
                                echo "<input type='checkbox' name='profileperm[]'"."value='".$ap->getCodpermission()."' checked >".$actionname."</input>";
                            }else{
                                echo "<input type='checkbox' name='profileperm[]'"."value='".$ap->getCodpermission()."'>".$actionname."</input>";
                            }
                        }
                    }
                    else{
                        $currentControllername = $allpermissions[0]->getController()->getControllername();
                        echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                        foreach ($allpermissions as $ap) {
                            //recuperamos os nomes do controlador  e accion do perfile a mostrar
                            $controllername = $ap->getController()->getControllername();
                            $actionname = $ap->getAction()->getActionname();
                            if($controllername != $currentControllername){
                                // echo "</div>";
                                $currentControllername = $controllername;
                                echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                            }
                            echo "<input type='checkbox' name='profileperm[]'"."value='".$ap->getCodpermission()."'>".$actionname."</input>";
                        }
                    }
                ?>
            </div>
        </div>

        <div style="margin-top:20px; margin-bottom: 20px" class="col-md-6 col-md-offset-3">
            <button class="btn btn-primary btn-md btn-block" name="submit" type="submit">
                <?php echo $strings['edit'] ?></i></button>

            <button class="btn btn-outline btn-warning btn-md btn-block" name="reset" type="reset">
                <?php echo $strings['clean'] ?></i></button>
        </div>
    </form>
    <!--fin formulario-->
</div>
