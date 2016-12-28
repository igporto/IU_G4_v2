<?php

/**
 * Default controller if any controller is passed in the URL
 */
define("DEFAULT_CONTROLLER", "User");

/**
 * Default action if any action is passed in the URL
 */
define("DEFAULT_ACTION", "login");


function run()
{
    try {
        if (!isset($_GET["controller"])) {
            $_GET["controller"] = DEFAULT_CONTROLLER;
        }

        if (!isset($_GET["action"])) {
            $_GET["action"] = DEFAULT_ACTION;
        }


        // Instantiate the corresponding controller
        $controller = loadController($_GET["controller"]);
        //if controller is not implemented, calls user/notImplemented to render a placeholder
        if ($controller != 'notImplemented') {
            // Call the corresponding action
            $actionName = strtolower($_GET["action"]);
            $controller->$actionName();
        } else {
            require_once(__DIR__ . "/controller/USER_controller.php");
            $controller = new UserController();
            $controller->notImplemented();
        }

    } catch (Exception $ex) {
        //uniform treatment of exceptions
        die("An exception occured!!!!!" . $ex->getMessage());
    }
}

/**
 * Load the required controller file and create the controller instance
 *
 * @param string $controllerName The controller name found in the URL
 * @return Object A Controller instance
 */
function loadController($controllerName)
{
    $controllerFileName = getControllerFileName($controllerName);
    $controllerClassName = getControllerClassName($controllerName);

    $file = __DIR__ . "/controller/" . $controllerFileName . ".php";

    //If file exists, returns a new controller
    if (file_exists($file)) {
        require_once($file);
        return new $controllerClassName();
    } //else returns a value to be handled by mainf index file
    else {
        return 'notImplemented';
    }
}

/**
 * Obtain the class name for a controller name in the URL
 *
 * For example $controllerName = "users" will return "UsersController"
 *
 * @param $controllerName The name of the controller found in the URL
 * @return string The controller class name
 */
function getControllerClassName($controllerName)
{
    return strToUpper(substr($controllerName, 0, 1)) . strtolower(substr($controllerName, 1)) . "Controller";
}

function getControllerFileName($controllerName)
{
    return strToUpper(substr($controllerName, 0, 1)) . strtoupper(substr($controllerName, 1)) . "_controller";
}

run();

?>
