<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTION_controller.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$codcategory = $_REQUEST["codcategory"];
$categoryMapper = new CategoryMapper();
$category = $categoryMapper->view($codcategory);
?>

<div class="col-md-12">
<h1 class="page-header"><?php echo $strings['category_modify'].': '.$category->getCategoryname()?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=category&action=edit&codcategory=<?php echo $codcategory; ?>"
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

                    <div class="col-xs-12 col-md-5">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus required  class="form-control" type="text" name="newcategoryname" maxlength="25"
                                   value=<?php echo $category->getCategoryname()?>>
                        </div>
                        <!--Campo nome-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=category&action=show">
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
