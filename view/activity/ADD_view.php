<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_activity']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=activity&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_activity'] ?>
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
                        <label for="selectperf"><?php echo $strings['aforo'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="number" class="form-control" id="capacity" name="capacity"
                                   placeholder= <?php echo $strings['aforo'] ?>>
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
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
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
                                    echo "<option value='" . $category->getCodcategory()."'>".$category->getCategoryname() . "</option>";
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
                                echo "<option value='" . $space->getCodspace()."'>".$space->getSpacename() . "</option>";
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
                                   placeholder= <?php echo $strings['color'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['price'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                            <input autofocus type="int"  type="number" min="0.01" step="0.01" max="2500000"
                                   class="form-control" id="price" name="price"
                                   placeholder= <?php echo $strings['price'] ?>>
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

<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>
