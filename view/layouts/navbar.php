<?php
// file: view/layouts/welcome.php
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$permis = $view->getVariable("currentperms");




?><!DOCTYPE html>
<html>
<head lang='en'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Estas 3 tags deben ir SEMPRE ANTES de calquera outra tag de head -->
    <title>Moovett Manager</title>

    <!--LINK DE CARGA DE BOOTSTRAP-->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="lib/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="lib/admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="lib/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="lib/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!--FAVICON-->
    <link rel="icon"
          type="image/ico"
          href="media/images/favicon.ico">

    <!--MULTIIDIOMA-->
    <link rel="stylesheet" href="core/language/css/language.css">

    <!-- jQuery, NECESARIO para scripts JS de Bootstrap, cargar ó final do body-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/bootstrap/js//bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript: MENU LATERAL DESPLEGABLE -->
    <script src="lib/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="lib/admin/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="lib/datatables-responsive/dataTables.responsive.js"></script>
    <?php
        include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
    ?>

</head>

<body>

<!--CONTEDOR DA PAXINA-->
<div id="wrapper">

    <!-- BARRA DE NAVEGACIÓN: HEADER -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"><?php echo $strings['toggle_navigation']; ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="index.php?controller=user&action=login">Moovett</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
           
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> <?php echo $strings['']; ?>
                                <span class="pull-right text-muted small"><?php echo $strings['']; ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong><?php echo $strings['']; ?></strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $strings['user_profile']; ?></a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> <?php echo $strings['settings']; ?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="index.php?controller=user&action=logout"><i
                                class="fa fa-sign-out fa-fw"></i> <?php echo $strings['close_session']; ?></a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
            <?php include(__DIR__."/language_select.php");  ?>
        </ul>
        <!-- /.navbar-top-links -->

        <!--BARRA DE NAVEGACIÓN LATERAL COLLAPSIBLE-->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                  
                   
                    <li>
                        <a href="index.php?controller=user&action=login"><i
                                class="fa fa-home fa-fw active"></i> <?php echo $strings['home']; ?></a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> <?php echo 'Login: '.$_SESSION['currentuser'];
                                                                          ?><span class='fa arrow'></span></a>
                       
                        <ul id='menu1' class='nav nav-second-level'>
                            <li><a href="index.php?controller=user&action=logout"><i
                                class="fa fa-sign-out fa-fw"></i> <?php echo $strings['close_session']; ?></a>
                            </li>
                        </ul>
                    </li>
                    <!--RENDER MENU POR PERMISOS-->
                    <?php 

                            $currentController = " ";
                            foreach ($permis as $p) {

                                $controller = $p->getController()->getControllername();
                                if ($controller != $currentController) {
                                    echo '<li><a href="#"><i class="fa fa-cog fa-fw"></i>';
                                    echo $strings[$controller];
                                    echo "<span class='fa arrow'></span></a><ul id='menu1' class='nav nav-second-level'>";
                                    $currentController = $controller;

                                    $action = $p->getAction()->getActionname();

                                    if($action = "ADD") {
                                        echo "<li>
                                          <a href='index.php?controller=" . $controller . "&action=" . $action . "'><i class=\"fa fa-plus fa-fw\"></i> " . $strings[$action] . "</a>
        
                                          </li>";
                                    }
                                    if($action = "SHOW") {
                                        echo "<li>
                                         <a href='index.php?controller=" . $controller . "&action=" . $action . "'><i class=\"fa fa-cogs fa-fw\"></i> " . $strings["manage"] . "</a> 
                                          </li>";
                                        }
                                        echo "</li></ul>";
                                }
                            }
                     ?>

                    </ul>
                    </div>
            <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            </nav>

<!-- CONTIDO DA PAXINA -->
<div id='page-wrapper'>
    <div class='container-fluid'>
                
                <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>



    </div>
    <!-- FIN CONTAINER -->
</div>
<!-- FIN PAGE WRAPPER -->


</div>
<!--FIN WRAPPER-->


</body>

</html>


