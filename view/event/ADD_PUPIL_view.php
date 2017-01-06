<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$userMapper = new EventMapper();
?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['add_student']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=event&action=addpupil"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_event'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">

                        <label for="divdatestart"><?= $strings['dni']." ".$strings['student']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                            <select name="codpupil">
                                <?php
                                $s = new EventMapper();
                                $a = $s->selectDniA();
                                foreach ($a as $b){
                                    echo '<option value="'.$b.'">'.$s->getDniId($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo dni-->
                    </div>
                    <div class="col-xs-12 col col-md-5">

                        <label for="divdatestart"><?= $strings['EVENTS_NAME']  ?></label><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                            <select name="id_evento">
                                <?php
                                $s = new EventMapper();
                                $a = $s->selectEventID();
                                foreach ($a as $b){
                                    echo '<option value="'.$b.'">'.$s->getNameEvent($b).'</option>';
                                }
                                ?>
                            </select>
                            <!--Campo name-->
                        </div>

                    </div>

                </div>
                </div>

            </div>


        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=event&action=show">
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

