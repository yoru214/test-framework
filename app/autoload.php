<?php
spl_autoload_register(
    function ($className) {
        if(substr($className, -7) == "_Config") {
            $path = APP . '/config/'. strtolower(str_replace("_Config", "", $className)) . '.php';
            if(file_exists($path)) {
                include_once  $path;
            }
        }
        else if(file_exists(APP . '/'. $className . '.php')) {
            include_once  APP . '/' . $className . '.php';
        }
        else if(file_exists(LIB . '/' .$className . '.php')) {
            include_once LIB . '/'  . $className . '.php';
        }
        else if(file_exists(APP . '/controller/' .$className . '.php')) {
            include_once APP . '/controller/'  . $className . '.php';
        }
        else if(file_exists(APP . '/model/' .$className . '.php')) {
            include_once APP . '/model/'  . $className . '.php';
        }
    }
);
