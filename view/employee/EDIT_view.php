<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTIVITY_controller.php");
require_once(__DIR__ . "/../../model/EMPLOYEE_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$codemployee = $_REQUEST["codemployee"];
$employeeMapper = new EmployeeMapper();
$employee = $employeeMapper->view($codemployee);
?>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['employee_modify'].': '.$employee->getEmployeename()?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=employee&action=edit&codemployee=<?php echo $codemployee; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                        <!--  <div class="row">
                            <?php echo $strings['max_length'] ?>: 25
                        </div>-->
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
                        <label for="selectperf"><?php echo $strings['birthdate'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input autofocus type="date" class="form-control" id="birthdate" name="birthdate"
                                   placeholder= <?php echo $strings['birthdate'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo birthdate-->
                    </div>
                </div>
                <div class="row">
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
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['email'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
                            <input autofocus type="email" class="form-control" id="email" name="email"
                                   placeholder= <?php echo $strings['email'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo email-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['hour_in'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="hourin" name="hourin"
                                   placeholder= <?php echo $strings['hour_in'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo hour_in-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['hour_out'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="hourout" name="hourout"
                                   placeholder= <?php echo $strings['hour_out'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo hour_out-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['bank_account'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-bank fa-fw"></i></span>
                            <input autofocus type="number" class="form-control" id="banknum" name="banknum"
                                   placeholder= <?php echo $strings['bank_account'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo banknum-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['contract_type'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-paperclip fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="contracttype" name="contracttype"
                                   placeholder= <?php echo $strings['contract_type'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['employee_user'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus fa-fw"></i></span>
                            <select id='user' name='user' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por usuario a escoller
                            $userMapper = new UserMapper();

                            //Recuperamos todos os posibles usuario que se poden escoller para o empleado
                            $users = $userMapper->show();
                            echo "<option value='NULL'>".$strings['no_user']."</option>";
                            foreach ($users as $user) {
                                echo "<option value='" . $user->getCoduser()."'";
                                if($user->getCoduser() == $employee->getUser()->getCoduser()){
                                    echo " selected = 'selected' ";
                                }
                                echo "'>". $user->getUsername() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo username-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['personal_comment'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-text-width fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="comment" name="comment"
                                   placeholder= <?php echo $strings['personal_comment'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo aforo-->
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
