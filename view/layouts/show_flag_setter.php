<?php 		
 //obtemos o contido a mostrar
    $controllers = $view->getVariable("actionstoshow");
    
    $uc = new UserController();
    //Recollemos os usuarios
    
    $permissions = $uc->getCurrentUserPerms();

    $add = false;
    $delete = false;
    $edit = false;
    $v = false;
    //Comprobamos os permisos que ten o usuario actual
    foreach ($permissions as $perm){
    
        if($perm->getController()->getControllername() == strtoupper($_GET["controller"])){
            $action = $perm->getAction()->getActionname();
            if($action == "ADD"){
                $add = true;
            }
            elseif($action == "EDIT"){
                $edit = true;
            }
            elseif($action == "DELETE"){
                $delete = true;
            }
            elseif($action== "VIEW"){
                $v = true;
            }
        }
    }

                    

 ?>