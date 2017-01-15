<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");

$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-12" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['search_bill']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=bill&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['search_bill'] ?>
            </div>
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                   placeholder= <?php echo $strings['name'] ?>
                                   maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo nombre-->
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['bill_number'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                            <input type="number"
                                   class="form-control" id="number" name="number"
                                   placeholder= <?php echo $strings['bill_number'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo numero-->
                    </div>

                </div>

            </div>
        </div>
</div>

<div class="row">

    <div class="col-xs-12">
        <div class="pull-left">
            <a class="btn btn-default btn-md" href="index.php?controller=bill&action=show">
                <i class="fa fa-arrow-left"></i>
                <?php echo $strings['back'] ?></i></a>
        </div>

        <div class="pull-right">
            <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                <?php echo $strings['clean'] ?></i></button>
            <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                <i class="fa fa-search"></i>
                <?php echo $strings['find'] ?></i></button>
        </div>
    </div>

</div>
</form>

<!--fin formulario-->
</div>