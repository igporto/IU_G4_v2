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

    <!--AmaranJS for notifications-->
    <link rel="stylesheet" href="lib/amaranjs/css/amaran.min.css">

    <!--datepicker-->
    <link rel="stylesheet" href="lib/datepicker/css/datepicker.min.css">

    <!-- validations style -->
    <link rel="stylesheet" href="css/parsley.css">    

    <!--FAVICON-->
    <link rel="icon"
          type="image/ico"
          href="media/images/favicon.ico">

    <!--MULTIIDIOMA-->
    <link rel="stylesheet" href="core/language/css/language.css">

    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

    

     <!-- jQuery, NECESARIO para scripts JS de Bootstrap, cargar ó final do body-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <!-- jquery UI -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet">

     <!-- DataTables JavaScript -->
    <script src="lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="lib/datatables-responsive/dataTables.responsive.js"></script>

    <!-- includes for datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- calendar -->
    <link href='lib/calendar/fullcalendar.css' rel='stylesheet' />
    <link href='lib/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='lib/calendar/moment.min.js'></script>
    <script src='lib/calendar/fullcalendar.min.js'></script>

   
    <!-- validations library -->
    <script src="lib/parsley/parsley.min.js"></script>
     <?php 
    switch ($_SESSION['idioma']) {
        case 'GALEGO':
            echo '<script src="core/language/parsley/gl.js"></script>';
        break;
        case 'SPANISH':
            echo '<script src="core/language/parsley/es.js"></script>';
        break;

     } ?>

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
                        $controller = "";

                        foreach ($permis as $p) {
                            $controller = $p->getController()->getControllername();
                            $action = $p->getAction()->getActionname();
                                if($action == "SHOW") {
                                    array_push($controllertoShow,$controller);
                                }
                            
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
                                            echo "WIP: ".$c;
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


<!-- SCRIPTS -->


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/bootstrap/js//bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript: MENU LATERAL DESPLEGABLE -->
    <script src="lib/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="lib/admin/js/sb-admin-2.js"></script>

   

    <!--AmaranJS for notifications-->
    <script src="lib/amaranjs/js/jquery.amaran.js"></script>

    <!-- datepicker -->
    <script src="lib/datepicker/js/datepicker.min.js"></script>



 <?php 
        //mostrado de notificacións flash
        $flag ='';
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
                                            icon:'fa fa-ban'
                                            
                                        },
                                        theme:'awesome error',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom',
                                        'sticky': true
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
                                            icon:'fa fa-times'
                                            
                                        },
                                        theme:'awesome warning',
                                        'position'  :'bottom right',
                                        'outEffect' :'slideBottom',
                                        'sticky': true
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


