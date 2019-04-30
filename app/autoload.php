<?php
spl_autoload_register(function($className) {
    if(substr($className,-7) == "_Config")
    {
        $path = APP . '/config/'. strtolower(str_replace("_Config","",$className)) . '.php';
        if(file_exists($path))
        {
            require_once  $path;
        }
    }
    else if(file_exists( APP . '/'. $className . '.php'))
    {
        require_once  APP . '/' . $className . '.php';
    }
    else if(file_exists( LIB . '/' .$className . '.php'))
    {
        require_once LIB . '/'  . $className . '.php';
    }
    else if(file_exists( APP . '/controller/' .$className . '.php'))
    {
        require_once APP . '/controller/'  . $className . '.php';
    }
    else if(file_exists( APP . '/model/' .$className . '.php'))
    {
        require_once APP . '/model/'  . $className . '.php';
    }
});