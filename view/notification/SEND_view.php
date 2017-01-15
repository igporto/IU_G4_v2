<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
require_once(__DIR__ . "/../../model/CLIENT_model.php");
?>

<script>
    function enviar() {
        var ruta = 'index.php?controller=notification&action=send&take_id=';
        var nome = document.getElementById("take_id").value;

        window.location.href = ruta.concat(nome);
    }
</script>
<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_notification']; ?></h1>
    <form name="form" id="form" method="POST"
          notification="index.php?controller=notification&action=send"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['send_email'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['message'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <textarea required="true" class="form-control"  name="message" ></textarea>
                        </div>
                        <!--Campo desconto-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['subject'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <select class="form-control" name="subject">
                            <?php
                            $nm = new NotificationMapper();
                            $notifications = $nm->show();
                            foreach ($notifications as $n) {
                                ?>
                                <option value="<?php echo $n->getDescription() ?>"><?php echo $n->getCodnotification() . " " . $n->getDescription() ?></option>
                                <?php
                            }?>
                            </select>
                        </div>
                        <!--Campo desconto-->
                    </div>
                </div>
                <div class="form-group"><!-- div1 -->
                    <label><?php echo $strings['destiny'] ?>: </label>
                    <select id='take_id' name='take_id' class='form-control' onchange='enviar()'>
                        <option value="0"><?php echo $strings['free_take']?></option>
                        <option value="1"><?php echo $strings['activity_clients']?></option>
                        <option value="2"><?php echo $strings['event_clients']?></option>
                        <option value="3"><?php echo $strings['all_clients']?></option>
                    </select>
                </div>

                <div class="row">
                    <label for="well"><?php echo $strings['clients']?>: </label>
                    <div id="well" class="well">

                            <?php

                            if(isset($_REQUEST["take_id"]) && $_REQUEST["take_id"] != "NULL") {
                                $mark = false;
                                if ($_REQUEST["take_id"] == 0) {
                                    $cm = new ClientMapper();
                                    $clients = $cm->show();
                                } elseif ($_REQUEST["take_id"] == 1) {
                                    $am = new ActivityMapper();
                                } elseif ($_REQUEST["take_id"] == 2) {

                                } elseif ($_REQUEST["take_id"] == 3) {
                                    $cm = new ClientMapper();
                                    $clients = $cm->show();
                                    $mark = true;
                                }

                                echo "<div class='form-group'>";

                                foreach ($clients as $c) {
                                    if ($mark) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="destiny[]" value="<?php echo $c->getEmail()?>" checked>
                                                <?php echo $c->getName() . " " . $c->getSurname() ." -> ". $c->getEmail() ?>
                                            </label>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="destiny[]" value="<?php echo $c->getEmail()?>" >
                                                <?php echo $c->getName() . " " . $c->getSurname() ." -> ". $c->getEmail() ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            }?>
                    </div><!-- /div2 -->
                </div>
            </div>
                <!-- /form-group -->
        </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=notification&action=show">
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
