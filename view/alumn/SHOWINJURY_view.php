<!--SCRIPT DE DATATABLE-->
<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");
require_once(__DIR__ . "/../../model/CONTROLLER_model.php");


include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__."/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__."/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$injurys = $view->getVariable("injurystoshow");

?>

<div class="col-xs-12 col-md-8 ">

    <h1 class="page-header"><?php echo $strings['list_of_injurys'] ?></h1>

    <div class="row">


        <!--BOTÃƒâ€œN QUITAR FILTRO-->
        <a class="btn btn-warning btn-outline"  href="index.php?controller=alumn&action=show">
            <i class="fa fa-search-minus"></i>
            <?php echo $strings['clean'];?>
        </a>

        <a href="index.php?controller=alumn&action=addinjury&codalumn=<?php echo $_GET['codalumn']?>">
            <button type="button" class="btn btn-success">
                <i class="fa fa-fw fa-plus"></i>
                <?php echo $strings['create_injury'] ?>
            </button>
        </a>

    </div>



    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of_injurys']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row" >
                        <!--CADA UN DE ESTES E UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['injury_name']?></th>
                        <th class="text-center"><?php echo $strings['date_injury']?></th>
                        <th class="text-center"><?php echo $strings['date_recovery']?></th>
                        <?php
                        if(!$edit && !$delete){ ?>
                            <th class="text-center"><?php echo $strings['no_actions_to_do']?></th>
                            <?php
                        }else{
                            ?>
                            <th class="text-center"><?php echo $strings['ACTION']?></th>
                        <?php } ?>

                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES E UNHA FILA-->

                    <?php


                    foreach ($injurys as $i) {

                        echo "<tr class='row text-center' ><td> ";


                        echo $i->getInjury()->getNameInjury() . "</td><td> ";

                        echo $i->getDate() . "</td><td> ";
                        if($i->getDateRecovery() != NULL){
                            echo $i->getDateRecovery() ;
                        }else{
                            echo $strings['not_recovered_yet'];
                        }
                        echo "</td><td class='text-center'>";

                        if($i->getDateRecovery() == NULL){
                            echo "<a href=index.php?controller=alumn&action=editinjury&codinjurypupil=".$i->getCod().">";
                            echo "<button class='btn btn-success btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-check fa-fw'></i></button></a>";
                        }else{
                            echo "<a href=index.php?controller=alumn&action=editinjury&codinjurypupil=".$i->getCod().">";
                            echo "<button class='btn btn-success btn-xs ";
                            echo "' disabled style='margin:2px'>";
                            echo "<i class='fa fa-check fa-fw'></i></button></a>";
                        }
                        echo "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=alumn&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>
            </div>

        </div>

    </div><!-- fin row -->
</div><!-- fin contedor -->

