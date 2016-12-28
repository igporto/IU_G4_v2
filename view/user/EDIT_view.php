<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

    $userMapper = new UserMapper();
    $profileMapper = new ProfileMapper();
    //Recuperamos o id do usuario a editar
    $username = $_REQUEST["user"];
    $currentUser = $userMapper->view($userMapper->getIdByName($username));

    //$perf_id = $_GET['perf_id'];

?>

<!-- refresca o perfil do select -->
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

<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['user_modify'].": ".$currentUser->getUsername() ; ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=user&action=edit&user=<?php echo $username; ?>"
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
                                                 
                    </div>
                    <div class="col-xs-12  col-md-5 pull-right">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="password" name="newpass"
                                autofocus    placeholder=<?php echo $strings['newpass'];?> >
                        </div>
                    </div>
                        <!--Campo name-->
                </div>

                <?php 
                    if(!isset($_GET["perf_id"])){
                        $c = $currentUser->getProfile();

                    }
                    else{
                        $c = $profileMapper->view($_REQUEST["perf_id"]);
                    }
                   
                 ?>
                

                <div class="row">
                
                    <div class="col-xs-10 col-md-5 pull-right">
                                 <label for="selectperf"><?php echo $strings['profile_type']; ?></label>
                        <div id="selectperf" class="form-group">
                            <div class="form-group input-group">
                                <span class="input-group-btn">
                                <button class="btn btn-info" type="button" 
                                        data-toggle="modal" 
                                        data-target="#view<?php echo $c->getProfilename();?>">
                                        <i class="fa fa-eye fa-fw"></i>
                                </button>
                                </span>
                                
                                <select id='perf_id' name='perf_id' class='form-control icon-menu'
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

                                            //Se é o perfil que ten o usuario a editar poñemolo como selecionado por defecto
                                            if ($c->getCodprofile() == $profile->getCodprofile()) {
                                                echo " selected ";
                                            }
                                            echo ">" . $profile->getProfilename() . "</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- vista de modal de perfil -->
                <?php  include(__DIR__.'/../profile/VIEW_view.php');?>

                
                

                <!-- checks dos permisos -->
                <label for="well"><?php echo $strings["PERMISSION"].":"; ?></label>
                <div id="well" class="well">
                <div class="row">
                    

                        
                        
                    
                        <?php    
                        //PERMISOS PROPIOS DO PERFIL
                        //recorremos os permisos do perfil(so se mostran xa que non se poden modificar)
                        $pm = new PermissionMapper();
                        $allperms = $pm->show();
                        $userperms = $currentUser->getPermissions()->getUserPermissions();

                        if ($userperms != NULL) {
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
                                       
                                    echo "<div class='checkbox'><label><input type='checkbox' name='userperm[]' value='".$p->getCodpermission()."'";



                                    //marcar o permiso se xa o ten o perfil
                                    if (in_array($p, $userperms)) {
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
                                    
                                        echo "<div class='checkbox'><label><input type='checkbox' name='userperm[]' value='".$p->getCodpermission()."'>".$actionname."</label></div>
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
                    <a class="btn btn-default btn-md" href="index.php?controller=user&action=show">
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

