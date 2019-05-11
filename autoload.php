<?php

// hace un include de todos los controladores de la carpeta controllers
function controllers_autoload($classname){
    include 'controllers/'. $classname . '.php';
}

spl_autoload_register('controllers_autoload');