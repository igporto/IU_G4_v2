<!-- CONTIDO DA PAXINA -->

<?php
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

?>

<script>
    function enviar() {
        var aux1 = 'index.php?controller=USER&action=edit&profileEdit=';
        var aux = document.getElementById("perf_id").value;
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
                        <select id='perf_id' name='perf_id' class='form-control icon-menu'
                                onchange='enviar()'>
                            <?php
                            require_once('controllers/PROFILE_controller.php');
                            $pc = new PROFILE_controller();
                            $profiles = $pc->getprofiles();
                            foreach ($profiles as $key => $v) {

                                echo "<option value='" . $v["perf_id"];
                                if ($profile_id == $v["perf_id"]) {
                                    echo "' selected='selected'";
                                }

                                echo "'>" . $v["name"] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>

                <?php

                require_once('controllers/USER_controller.php');
                $uc = new USER_controller();
                $permissions = $uc->getUserPerms($_REQUEST["user"]);

                require_once('controllers/CONTROLLER_controller.php');
                $cc = new CONTROLLER_controller();
                $controllersActions = $cc->getControllersActions();
                $controllersAll = array();

                foreach ($controllersActions as $key => $value) {
                    array_push($controllersAll, $value["controller_name"]);
                }

                $controllersAll = array_unique($controllersAll);

                $u_p_p = $uc->getProfilePerms($profile_id);
                $user_profile_perms = array();
                foreach ($u_p_p as $item) {
                    array_push($user_profile_perms, $item["perm_id"]);
                }

                //IMPRESIÓN DOS PERMISOS DO USUARIO
                echo "<div><div><label>".$strings['perm_over_controller']."</label>: </div><div><p class='help-block'>".$strings['not_edit_perm']."</div>"	;

                foreach ($controllersAll as $key1 => $value1) {
                	echo "<div class='col-md-6'>";
                    echo "<div class='text-center'><label>".$value1 . "</label>: </div><div class='text-center'>";

                    foreach ($controllersActions as $key2 => $value2) {

                        if ($value1 == $value2["controller_name"]) {
                            $perm_id = $value1 . "_" . $value2["action_name"];
                            echo "<input type='checkbox' name='" . $perm_id . "' " . "value='" . $perm_id . "'";

                            if (in_array($perm_id, $permissions)) {
                                echo " checked";
                            }

                            $perm_id_subs = substr($value1, 0, 4) . "_" . substr($value2["action_name"], 0, 4);
                            if (in_array($perm_id_subs, $user_profile_perms)) {
                                echo " checked disabled";
                            }

                            echo ">" . $value2["action_name"];
                            echo "<br>";
                        }
                    }
                    echo "<br></div></div>";
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
