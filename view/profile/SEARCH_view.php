<!-- CONTIDO DA PAXINA -->

<?php
    require_once(__DIR__ . "/../../controller/PROFILE_controller.php");
    require_once(__DIR__ . "/../../model/PERMISSION_model.php");
    include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
  

?>


<div class="col-md-8 col-md-offset-2" style="margin-top: 20px">
<h1 class="panel-heading">Buscar perfiles</h1>
    <form method="POST" name="form" id="form"
          action="index.php?controller=profile&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['find'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="text" name="profilename"
                                   placeholder=<?php echo $strings[''];?> >
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
                          <div><p class='help-block'>".$strings['']."</div>";

                    $pm = new PermissionMapper();
                    $perms = $pm->show();
                    
                    //Comprobamos que ten permisos para mostrar
                   
                        $curController = $perms[0]->getController()->getControllername();
                        echo "<div class='text-center'><label>".$curController. "</label></div>"; 
                        foreach ($perms as $ap) {
                            //recuperamos os nomes do controlador  e accion do perfile a mostrar
                            $controllername = $ap->getController()->getControllername();
                            $actionname = $ap->getAction()->getActionname();
                            if($controllername != $curController){
                                // echo "</div>";
                                $curController = $controllername;
                                echo "<div class='text-center'><label>".$curController. "</label></div>";
                            }
                            echo "<input type='checkbox' name='profileperm[]'"."value='".$ap->getCodpermission()."'>".$actionname."</input>";
                        }
                    
                ?>
            </div>
        </div>

        <div style="margin-top:20px; margin-bottom: 20px" class="col-md-6 col-md-offset-3">
            <button class="btn btn-primary btn-md btn-block" name="submit" type="submit">
                <?php echo $strings['find'] ?></i></button>

            <button class="btn btn-outline btn-warning btn-md btn-block" name="reset" type="reset">
                <?php echo $strings['clean'] ?></i></button>
        </div>
    </form>
    <!--fin formulario-->
</div>
