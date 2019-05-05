<?php
/**
 * Controller.php
 * PHP Version 7.2.10
 * 
 * @category Library\Interfaces
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Library;
/**
 * Controller Class
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Controller
{
    var $ROUTE_SEGMENTS = array();
    var $PAGE_TITLE;
    var $VIEW_VARIABLES;
    var $db;
    var $VIEW = true;
    var $Session;
    var $Authenticate;
    /**
     * Allows the loading of Model on the controller.
     *
     * @param String $ModelName  Name of the Model.
     * @param String $ModelClass Custom name of the Model. (not implemented)
     * 
     * @return void
     */
    public function loadModel(String $ModelName,String $ModelClass=null) : void
    {
        $ModelNameSpace = "\\Model\\".$ModelName;
        $this->$ModelName = new $ModelNameSpace();
    }
    /**
     * Load Database based on atrribute arrays on Database Config.
     *
     * @param String $name Name of the datavase config.
     * 
     * @return void
     */
    public function loadDatabase(String $name="default") : void
    {
        $dbConfig = new Database_Config();
        $this->db[$name]=$dbConfig->$name;
    }
    /**
     * Sets variables that will be accessible on the Views
     *
     * @param String $name  Name of the variable.
     * @param String $value Value to be passed.
     * 
     * @return void
     */
    public function set(String $name, String $value) : void
    {
        $this->VIEW_VARIABLES[$name]=$value;
    }
    /**
     * Gets the segments on the route string
     * Segments are separated by '/' caracter
     *
     * @param integer $i index of the segment (having 0 as the first).
     * 
     * @return String|null returns the segment string or null if empty
     */
    public function segment(int $i) : ?String
    {
        if (count($this->ROUTE_SEGMENTS)>($i-1))
        {
            return $this->ROUTE_SEGMENTS[$i];
        } 
        else
        {
            return "";
        }
    }
}
