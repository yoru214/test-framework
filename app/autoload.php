<?php
spl_autoload_register (
    function ($className) {

        $segments = explode("\\", $className);

        $classFile = $segments[count($segments)-1];

        if (substr($classFile, -7) == "_Config") {
            $path = APP . '/config/'. strtolower(str_replace("_Config", "", $classFile)) . '.php';
            if (file_exists($path)) {
                include_once  $path;
            }
        }
        else if(file_exists(APP . '/'. $classFile . '.php')) {
            include_once  APP . '/' . $classFile . '.php';
        }
        else if(file_exists(LIB . '/' .$classFile . '.php')) {
            include_once LIB . '/'  . $classFile . '.php';
        }
        else if(file_exists(APP . '/controller/' .$classFile . '.php')) {
            include_once APP . '/controller/'  . $classFile . '.php';
        }
        else if(file_exists(APP . '/model/' .$classFile . '.php')) {
            include_once APP . '/model/'  . $classFile . '.php';
        }
    }
);
