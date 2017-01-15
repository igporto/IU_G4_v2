<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-12 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_notification']; ?></h1>
    <form name="form" id="form" method="POST"
          notification="index.php?controller=notification&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_notification'] ?>
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
                        <label for="selectperf"><?php echo $strings['description'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-text-width fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="notificationname" name="description"
                                   placeholder="<?php echo $strings['description'] ?>"
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo notification-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_user'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <select id='discount' name='user' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $um = new UserMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $users = $um->show();

                            foreach ($users as $user) {
                                echo "<option value='" . $user->getCoduser()."'>". $user->getUsername() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo desconto-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=notification&notification=show">
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