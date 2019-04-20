<?php
class Controller
{
    var $ROUTE_SEGMENTS = array();
    var $PAGE_TITLE;
    var $VIEW_VARIABLES;
    var $db;
    function loadModel($ModelName,$ModelClass=null)
    {

    }

    function loadDatabase($name="default",$value=array())
    {
        $this->db[$name]=$value;
    }

    function set($name,$value)
    {
        $this->VIEW_VARIABLES[$name]=$value;
    }

    function segment($i)
    {
        if(count($this->ROUTE_SEGMENTS)>($i-1))
        {
            return $this->ROUTE_SEGMENTS[$i];
        }
        else{
            return "";
        }
    }
}