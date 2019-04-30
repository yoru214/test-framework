<?php
namespace Library;

class Controller
{
    var $ROUTE_SEGMENTS = array();
    var $PAGE_TITLE;
    var $VIEW_VARIABLES;
    var $db;
    var $VIEW = true;
    var $Session;
    var $Authenticate;
    function __construct()
    {
        
    }
    static function load()
    {
        return true;
    }

    function loadModel(String $ModelName,String $ModelClass=null)
    {
        $ModelNameSpace = "\\Model\\".$ModelName;
        $this->$ModelName = new $ModelNameSpace();
    }

    function loadDatabase(String $name="default")
    {
        $dbConfig = new Database_Config();
        $this->db[$name]=$dbConfig->$name;
    }

    function set(String $name, String $value)
    {
        $this->VIEW_VARIABLES[$name]=$value;
    }

    function segment(int $i)
    {
        if(count($this->ROUTE_SEGMENTS)>($i-1)) {
            return $this->ROUTE_SEGMENTS[$i];
        }
        else{
            return "";
        }
    }
}
