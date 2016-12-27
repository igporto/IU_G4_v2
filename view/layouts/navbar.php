<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();
$uc = new UserController();
$permis = $uc->getCurrentUserPerms();




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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

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

    <!--AmaranJS for notifications-->
    <link rel="stylesheet" href="lib/amaranjs/css/amaran.min.css">
    <script src="lib/amaranjs/js/jquery.amaran.js"></script>
</head>

<body>

<!--CONTEDOR DA PAXINA-->
<div id="wrapper">

    <!-- BARRA DE NAVEGACIÓN: HEADER -->
    <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand float-xs-left" href="index.php?controller=user&action=login">
               Moovett      
            </a> 
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
           
            <!-- /.dropdown -->
            <li class="nav-item" style="margin-top: 8px">
               <?php include(__DIR__."/language_select.php");  ?>
            </li>
          
            <!-- /.dropdown -->
            
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
                        $controllertoShow = array();
                        $currentController = " ";

                        foreach ($permis as $p) {
                            $controller = $p->getController()->getControllername();
                            //mentres sigamos co mesmo controlador comprobamos as accions asociadas
                            if ($controller == $currentController) {
                                $action = $p->getAction()->getActionname();
                                if($action == "SHOW") {
                                    array_push($controllertoShow,$controller);
                                }
                            }
                            $currentController = $controller;
                        }

                        $controllers = array_unique($controllertoShow);

                        foreach ($controllers as $c){
                            echo '<li>
                                     <a href="index.php?controller=' . strtolower($c) . '&action=show" >
                                         <i class="fa fa-edit fa-fw" aria-hidden="true"></i><span class="pull-right"><i class="fa fa-arrow-right"></i></span> ';
                                        if (isset($strings[$c])){
                                            echo $strings[$c];
                                        }
                                        else{
                                            echo $strings[""].": ".$c;
                                        }
                                echo "</a>";
                            echo "</li>";
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
                <!--CARGAR FRAGMENTO INTERNO-->  
                <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </div>
    <!-- FIN CONTAINER -->
</div>
<!-- FIN PAGE WRAPPER -->


</div>
<!--FIN WRAPPER-->


 <?php 
                //mostrado de notificacións flash
        
        $flag = $view->popFlash();
                if($flag != '')
                {
                    $tipo = substr($flag, 0, 4);

                    switch ($tipo) {
                        case 'succ':
                            echo "<script>
                                    $.amaran({
                                        content:{
                                            title:'" . $strings[$tipo."_title"] . "',
                                            message:'" . $strings[$flag] . "',
                                            info: '',
                                            icon:'fa fa-check',
                                            'delay'     :10000
                                        },
                                        theme:'awesome ok',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom'
                                    });
                                </script>";
                            break;

                        case 'erro':
                            echo "<script>
                                    $.amaran({
                                        content:{
                                            title:'" . $strings[$tipo."_title"] . "',
                                            message:'" . $strings[$flag] . "',
                                            info: '',
                                            icon:'fa fa-ban',
                                            'delay'     :10000
                                        },
                                        theme:'awesome error',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom'
                                    });
                                </script>";
                            break;

                        case 'fail':
                            echo "<script>
                                    $.amaran({
                                        content:{
                                            title:'" . $strings[$tipo."_title"] . "',
                                            message:'" . $strings[$flag] . "',
                                            info: '',
                                            icon:'fa fa-times',
                                            'delay'     :10000
                                        },
                                        theme:'awesome warning',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom'
                                    });
                                </script>";
                            break;

                        case 'info':
                            echo "<script>
                                    $.amaran({
                                        content:{
                                            title:'" . $strings[$tipo."_title"] . "',
                                            message:'" . $strings[$flag] . "',
                                            info: '',
                                            icon:'fa fa-info',
                                            'delay'     :10000
                                        },
                                        theme:'awesome blue',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom'
                                    });
                                </script>";
                            break;
                        
                        default:
                            echo "<script>
                                    $.amaran({
                                        content:{
                                            title:'Undefined',
                                            message:'" . $strings[$flag] . "',
                                            info: '',
                                            icon:'fa fa-code',
                                            'delay'     :10000
                                        },
                                        theme:'awesome ok',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom'
                                    });
                                </script>";
                            break;
                    }
                      
                } 
    ?>
</body>

</html>


