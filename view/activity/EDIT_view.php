<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTIVITY_controller.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$codactivity = $_REQUEST["codactivity"];
$activityMapper = new ActivityMapper();
$activity = $activityMapper->view($codactivity);
?>

<div class="col-md-12">
    <h1 class="page-header"><?php echo $strings['activity_modify'].': '.$activity->getActivityname()?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=activity&action=edit&codactivity=<?php echo $codactivity; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body container-fluid">

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
                                   value= <?php echo $activity->getActivityname() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['aforo'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="number" class="form-control" id="capacity" name="capacity"
                                   value= <?php echo $activity->getCapacity() ?>
                            <div id="error"></div>
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['discount'] ?>% (100 - 0)</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='discount' name='discount' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $discountMapper = new DiscountMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $discounts = $discountMapper->show();

                            foreach ($discounts as $discount) {
                                echo "<option value='" . $discount->getCoddiscount()."'";
                                if($discount->getCoddiscount() == $activity->getDiscount()->getCoddiscount()){
                                    echo " selected = 'selected' ";
                                }
                                echo "'>". $discount->getPercent() . "%</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo desconto-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['monitor'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='employee' name='employee' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $employeeMapper = new EmployeeMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $employees = $employeeMapper->show();

                            foreach ($employees as $employee) {
                                echo "<option value='" . $employee->getCodemployee()."'";
                                if($employee->getCodemployee() == $activity->getEmployee()->getCodemployee()){
                                    echo "selected = 'selected'";
                                }
                                echo ">". $employee->getEmployeename() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo monitor-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_category'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='category' name='category' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $categoryMapper = new CategoryMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $categories = $categoryMapper->show();
                            echo "<option value='NULL'>".$strings['no_category'] . "</option>";
                            foreach ($categories as $category) {
                                echo "<option value='" . $category->getCodcategory()."'";
                                if($activity->getCategory()->getCodcategory() == $category->getCodcategory()){
                                    echo " selected = 'selected' ";
                                }
                                echo ">".$category->getCategoryname() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo categoria-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_space'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='space' name='space' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $spaceMapper = new SpaceMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $spaces = $spaceMapper->show();

                            foreach ($spaces as $space) {

                                echo "<option value='" . $space->getCodspace()."'";
                                if($activity->getSpace()->getCodspace() == $space->getCodspace()){
                                    echo " selected = 'selected' ";
                                }
                                echo ">".$space->getSpacename() . "</option>";

                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo espazo-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['color'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="color" class="form-control" id="color" name="color"
                                   value="<?php echo $activity->getColor() ?>">
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['price'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                            <input autofocus type="number"  type="number" min="0.01" step="0.01" max="2500000"
                                   class="form-control" id="price" name="price" value= <?php echo $activity->getPrice() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=activity&action=show">
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
