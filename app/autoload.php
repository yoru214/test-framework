<?php
/**
 * Autoload File (autolad.php)
 * Auto loads classes and prevents include duplications.
 * PHP Version 7.2.10
 * 
 * @category Global
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
spl_autoload_register(
    function ($className) {

        $segments = explode("\\", $className);

        $classFile = $segments[count($segments)-1];

        if (substr($classFile, -7) == "_Config")
        {
            $path = APP . '/config/';
            $path .= strtolower(str_replace("_Config", "", $classFile)) . '.php';
            if (file_exists($path))
            {
                include_once  $path;
            }
        } else if (substr($classFile, -8) == "Shipping") {
            $path = APP . '/components/Shipping/';
            $path .= strtolower(str_replace("Shipping", "", $classFile)) . '.php';
            if (file_exists($path)) {
                include_once  $path;
            }
        } 
        else if (substr($classFile, -9) == "Interface")
        {
            $path = LIB . '/Interfaces/Shipping/';
            $path .= str_replace("ShippingInterface", "", $classFile) . '.php';

            if (file_exists($path))
            {
                include_once  $path;
            }
        }
        else if (file_exists(APP . '/'. $classFile . '.php'))
        {
            include_once  APP . '/' . $classFile . '.php';
        } 
        else if (file_exists(LIB . '/' .$classFile . '.php')) 
        {
            include_once LIB . '/'  . $classFile . '.php';
        }
        else if (file_exists(APP . '/controller/' .$classFile . '.php')) 
        {
            include_once APP . '/controller/'  . $classFile . '.php';
        }
        
        if (file_exists(APP . '/model/' .$classFile . '.php')) 
        {
            include_once APP . '/model/'  . $classFile . '.php';
        }
    }
);
