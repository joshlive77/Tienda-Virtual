<?php

session_start();

// cargamos el autoload para tener aceso a los controladores
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

// conexion a la base de datos
// $db = Database::connect();

function show_error(){
    $error = new errorController();
    $error->index();
}
// cpmprobamo sis llega el controlador por la url
if (isset($_GET['controller'])) {
    // si llega generamos esta variable de nombre de controlador
    $nombre_controlador = $_GET['controller'].'Controller';
}
else if(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
}
else{
    // si no llega se corta la ejecucion º
    show_error();
    exit();
}

// comprobamos si existe el controlador con el nombre-variable que generamos antes
if (class_exists($nombre_controlador)) {
    // si existe creamos el objeto
    $controlador = new $nombre_controlador;
    // comprobamos si llega la accion y si el metodo exite dentro del controlador
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        // en caso de que exista se invoca al metodo
        $action = $_GET['action'];
        $controlador->$action();
    }
    else if(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controlador->$action_default();
        // $controlador->action_default();
    }
    else{
        show_error();
    }
}
else{
    show_error();
}
require_once 'views/layout/footer.php';