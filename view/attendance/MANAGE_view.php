<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');


$alumns = $view->getVariable("alumns");
$session = $view->getVariable("session");

?>


<div class="col-md-12 " style="margin-top: 20px; margin-bottom: 20px">
    <h1 class="page-header"><?php echo $strings['create_alumn']; ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=attendance&action=manage&id=<?= $session->getIdSession() ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_alumn'] ?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                <div class="well">
                	<div class="row">
                		<input type="checkbox" onClick="toggle(this)" /><?= $strings["all"] ?>
                	</div>
                	<div class="row">
                		 <?php foreach ($alumns as $alumn): ?>
            		<div class="col-md-3">
            			<label for=""><input id="input" type="checkbox" name="alumns[]" value="<?= $alumn->getCodalumn() ?>"><?= $alumn->getAlumnname() ?> <?= $alumn->getAlumnsurname() ?></label>
            		</div>           	
            	<?php endforeach ?> 
                	</div>
                </div>
                	
                </div>
    
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=session&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-plus"></i>
                        <?php echo $strings['ADD'] ?></i></button>
                    <?php

                    ?>
                </div>
            </div>

        </div>
    </form>
    <!--fin formulario-->
</div>



<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('alumns[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
