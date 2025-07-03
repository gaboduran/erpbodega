<?php
    session_start();
    require_once ("Helpers/Helpers.php");
    require_once ("Config/Config.php");
    $ruta = !empty($_GET['url']) ? $_GET['url'] : CONTROLLER_DEFAULT."/".METHOD_DEFAULT;
    $array = explode("/", $ruta);
    $controller = $array[0];
    $metodo = METHOD_DEFAULT;
    $parametro = "";
    if (!empty($array[1])) {
        if (!empty($array[1] != "")) {
            $metodo = $array[1];
        }
    }
    if (!empty($array[2])) {
        if (!empty($array[2] != "")) {
            for ($i = 2; $i < count($array); $i++) {
                $parametro .= $array[$i] . ",";
            }
            $parametro = trim($parametro, ",");
        }
    }

    require_once 'Config/App/autoload.php';
    $dirController =   CONTROLLER. "/" . $controller . ".php";
    $errorCotrolller = CONTROLLER. "/" . "Error404.php";
    $unauthorized = CONTROLLER. "/" . "Error401.php";

    if (file_exists($dirController)) {
           require_once $dirController;
            $controller = new $controller();
            if (method_exists($controller, $metodo)) {
                $controller->$metodo($parametro);
            } else {
                require_once $unauthorized;
                $pageError = new Error401();
                $pageError->index();
            }
    }else {
            require_once $errorCotrolller;
            $pageError = new Error404();
            $pageError->index();
    
    }