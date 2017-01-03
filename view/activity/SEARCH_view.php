<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$discountMapper = new DiscountMapper();
$employeeMapper = new EmployeeMapper();
$categoryMapper = new CategoryMapper();
?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["ACTIVITY"] ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=activity&action=search"
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
                    <div class="col-xs-12  col-md-5 pull-left">
                        <label for="selectperf"><?php echo $strings['code'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="codactivity" placeholder="<?php echo $strings['code'];?>" >
                        </div>
                    </div>
                    <!--Campo codigo-->
                    <div class="col-xs-12  col-md-5 pull-left">
                        <label for="selectperf"><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="text" name="name" placeholder="<?php echo $strings['name'];?>" >
                        </div>
                    </div>
                    <!--Campo name-->
                </div>
                <div class="row">
                    <div class="col-xs-12  col-md-5 pull-left">
                        <label for="selectperf"><?php echo $strings['aforo'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="capacity" placeholder="<?php echo $strings['aforo'];?>" >
                        </div>
                    </div>
                    <!--Campo codigo-->
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_category'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                    <input id="usecat" name="usecat" type="checkbox">
                                </span>
                            <select id='category' name='category' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $categoryMapper = new CategoryMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $categories = $categoryMapper->show();

                            foreach ($categories as $category) {
                                echo "<option value='" . $category->getCodcategory()."'>".$category->getCategoryname() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo categoria-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['discount'] ?>% (100 - 0)</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                <input id="usedis" name="usedis" type="checkbox">
                            </span>
                            <select id='discount' name='discount' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $discountMapper = new DiscountMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $discounts = $discountMapper->show();

                            foreach ($discounts as $discount) {
                                echo "<option value='" . $discount->getCoddiscount()."'>". $discount->getType()." -> ". $discount->getPercent() . "%</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo desconto-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['monitor'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                <input id="useemp" name="useemp" type="checkbox">
                            </span>
                            <select id='employee' name='employee' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $employeeMapper = new EmployeeMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $employees = $employeeMapper->show();
                            foreach ($employees as $employee) {
                                echo "<option value='" . $employee->getCodemployee()."'>". $employee->getEmployeename() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo monitor-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_space'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                <input id="usespa" name="usespa" type="checkbox">
                            </span>
                            <select id='space' name='space' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $spaceMapper = new SpaceMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $spaces = $spaceMapper->show();

                            foreach ($spaces as $space) {
                                echo "<option value='" . $space->getCodspace()."'>".$space->getSpacename() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo espazo-->
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