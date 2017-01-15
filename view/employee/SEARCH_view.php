<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-12" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["EMPLOYEE"] ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=employee&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info " style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['code'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="code" name="code"
                                   placeholder= <?php echo $strings['code'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['employee_user'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                <input id="useuser" name="useuser" type="checkbox">
                            </span>
                            <select id='user' name='user' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por usuario a escoller
                            $userMapper = new UserMapper();

                            //Recuperamos todos os posibles usuario que se poden escoller para o empleado
                            $users = $userMapper->show();
                            echo "<option value='NULL'>".$strings['no_user']."</option>";
                            foreach ($users as $user) {
                                echo "<option value='" . $user->getCoduser()."'>". $user->getUsername() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo username-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                   placeholder= <?php echo $strings['name'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['surname'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="surname" name="surname"
                                   placeholder= <?php echo $strings['surname'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo surname-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['dni'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user-secret fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="dni" name="dni"
                                   placeholder= <?php echo $strings['dni'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo dni-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['address'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="address" name="address"
                                   placeholder= <?php echo $strings['address'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo address-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['contract_type'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-paperclip fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="contracttype" name="contracttype"
                                   placeholder= <?php echo $strings['contract_type'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo contrato-->
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=employee&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-search"></i>
                        <?php echo $strings['find'] ?></i></button>
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