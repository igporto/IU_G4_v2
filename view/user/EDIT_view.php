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
/*
    if (!isset($_SESSION["cambiado"])) {
        require_once('controllers/USER_controller.php');
        $uc = new USER_controller();
        $prof_id = $uc->getUserProfileId($_REQUEST["user"]);
        $profile_id = $prof_id;
        $_SESSION["editprofile"] = $prof_id;
    
    } elseif ($_SESSION["cambiado"] = false) {
        require_once('controllers/USER_controller.php');
        $uc = new USER_controller();
        $prof_id = $uc->getUserProfileId($_REQUEST["user"]);
        $profile_id = $prof_id;
        $_SESSION["editprofile"] = $prof_id;
    }
    
    if (isset($_SESSION["cambiado"]) && $_SESSION["cambiado"] = true) {
        $profile_id = $_SESSION["editprofile"];
    }
*/
?>

<script>
    function actualizar() {
        var aux1 = 'index.php?controller=USER&action=edit&user=';
        var aux = document.getElementById( $_REQUEST["user"]).value;
        
        window.location.href = aux1.concat(aux);
    }
</script>

<div class="col-md-8 col-md-offset-2" style="margin-top: 20px">
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=user&action=edit&function=edit&user= <?php echo $_REQUEST["user"] ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['user_modify'] . " " . $_REQUEST["user"] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="password" name="newpass"
                                   placeholder=<?php echo $strings['newpass']; ?>>
                        </div>
                        <!--Campo password-->
                    </div>
                </div>

                <label for=""><?php echo $strings['profile_type']; ?>:</label>
                <div class="form-group">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></span>
                        <select id='perf_id' name='profile' class='form-control icon-menu'
                                onchange='actualizar()'>
                            <?php
                                $um = new UserMapper();
                                $pc = new ProfileMapper();

                                //Recuperamos o id do usuario a editar
                                $id_user = $um->getIdByName($_REQUEST["user"]);

                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $profiles = $pc->show();

                                //Recuperamos o id do perfil do usuario a modificar para telo selecionalo previamente
                                $userProfile = $um->view($id_user)->getProfile()->getCodprofile();
                                foreach ($profiles as $profile) {

                                    echo "<option value='" . $profile->getCodprofile();

                                    //Se é o perfil que ten o usuario a editar poñemolo como selecionado por defecto
                                    if ($userProfile == $profile->getCodprofile()) {
                                        echo "' selected='selected'";
                                    }

                                    echo "'>" . $profile->getProfilename() . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <?php
                    //IMPRESIÓN DOS PERMISOS DO USUARIO
                    echo "<div>
                              <div>
                                    <label>".$strings['perm_over_controller']."</label>: 
                              </div>
                          <div><p class='help-block'>".$strings['not_edit_perm']."</div>";
                    //PERMISOS PROPIOS DO PERFIL
                    //recorremos os permisos do perfil(so se mostran xa que non se poden modificar)
                    $profileperms = $um->view($id_user)->getProfile()->getPermissions();
                    //axuda
                    $currentControllername = $profileperms[0]->getController()->getControllername();
                    echo "<div class='col-md-6 col-md-offset-3'>";

                        echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                        foreach ($profileperms as $p) {

                            //recuperamos os nomes do controlador  e accion do perfile a mostrar
                            $controllername = $p->getController()->getControllername();
                            $actionname = $p->getAction()->getActionname();

                            if($controllername != $currentControllername){
                               // echo "</div>";
                                $currentControllername = $controllername;
                                echo "<div class='text-center'><label>".$currentControllername. "</label></div>";
                            }
                            $perm_id = $actionname . "_" . $controllername;
                            echo "<input type='checkbox' name='" . $perm_id . "'"."value='".$p->getCodpermission()."' checked disabled >".$actionname."</input>";

                        }
                    //PERMISOS PROPIOS DO USUARIO
                    $pm = new PermissionMapper();
                    $allpermissions = $pm->show();
                    $userperms = $um->view($id_user)->getPermissions()->getUserPermissions();

                    echo "<div>
                            <label>".$strings['perm_over_controller']."</label>: 
                          </div>";

                    //Seteamos de novo o COntrolador do permiso actual
                    $currentControllername = $userperms[0]->getController()->getControllername();
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
                        if(in_array($controllername,$userperms)){
                            $perm_id = $actionname . "_" . $controllername;
                            echo "<input type='checkbox' name='" . $perm_id . "'"."value='".$ap->getCodpermission()."' checked >".$actionname."</input>";
                        }else{
                            echo "<input type='checkbox' name='" . $perm_id . "'"."value='".$ap->getCodpermission()."'>".$actionname."</input>";
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
