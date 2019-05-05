<?php
/**
 * Model.php
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Library;
/**
 * Model Class
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Model
{
    var $TABLE = "";
    var $DB = "";
    var $ERROR_MESSAGE = "";

    private $_CONFIG = array();
    private $_DBConnection;
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->TABLE = $this->pluralize(strtolower(get_class($this)));
        $this->DB = 'default';

        $config = array();
        
        $dbConfig = new \Config\Database_Config();
        $databases = get_object_vars($dbConfig);
        $config['database']=$databases;


        $this->CONFIG = $config['database'];
    }
    /**
     * Allows Models, Controllers and Components to get the Database Connection
     *
     * @return object|null
     */
    public function getDatabaseConnection() 
    {
        return new Database($this->DB);
    }
    /**
     * Returns All rows as array on the table link to the Model Class
     *
     * @param array $arguments conditions the will be transposed to where clause
     * 
     * @return array|null returns null if there is an error array if sucessful
     */
    public function findAll(array $arguments = array())
    {
        $this->DBConnection =  new Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        if ($ConnectionStatus["CODE"]=="1")
        {
            $where = "";
            if (count($arguments)>0) {
                if (isset($arguments['conditions'])) {
                    var_dump($arguments['conditions']);
                }
            }   
            $sql = "select * from " . $this->TABLE;
            $result = $this->DBConnection->result($sql);
            $object = array();
            while ($row = mysqli_fetch_object($result)) {
                $object[] = $row;
            }

            return $object;
        }
        else
        {
            $this->ERROR_MESSAGE = $ConnectionStatus['MESSAGE'];
            return null;
        }
    }
    /**
     * Returns a single row based on the given the conditions on the argument array
     *
     * @param array $arguments conditions the will be transposed to where clause
     * 
     * @return object|null  returns null if there is an error array if sucessful
     */
    public function find(array $arguments = array())
    {
        $this->DBConnection =  new Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        if ($ConnectionStatus["CODE"]=="1")
        {
            $sql = "select * from " . $this->TABLE;
            $where = "";
            if (count($arguments)>0) {
                if (isset($arguments['conditions'])) {
                    $sql .= " where ";
                    $cnt = 0;
                    foreach ($arguments['conditions'] as $field => $value) {
                        if ($cnt>0) {
                            $sql .= " AND ";
                        }
                        $sql .= " ";
                        $sql .= $field;
                        $sql .= " = ";
                        $sql .= "'".$value."'";
                        $cnt++;
                    }
                }
            }   

            $sql .= " limit 1";

            $result = $this->DBConnection->result($sql);
            return mysqli_fetch_object($result);
        }
        else
        {
            $this->ERROR_MESSAGE = $ConnectionStatus['MESSAGE'];
            return null;
        }
    }
    /**
     * Returns query results as an object
     *
     * @param String $sqlQuery String query
     * 
     * @return object|null returns null for error and object if sucess.
     */
    public function result($sqlQuery)
    {
        $this->DBConnection =  new \Library\Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        return $this->DBConnection->result($sqlQuery);
    }
    /**
     * Sql query for queries that ar not expecting returns
     *
     * @param String $sqlQuery String query
     * 
     * @return void
     */
    public function query($sqlQuery)
    {
        $this->DBConnection =  new \Library\Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();
        $this->DBConnection->query($sqlQuery);
    }
    /**
     * Pluralizing String Words
     * Used to autoconnect model to its respective table.
     *
     * @param String $string String wished to be pluralized
     * 
     * @return String
     */
    public function pluralize($string)
    {
        $lastChar = substr($string, -1);

        if ($lastChar == "s")
        {
            $string .= "ses";
        }
        else
        {
            $string .= "s";
        }
        $segments = explode("\\", $string);

        return $segments[count($segments)-1];
    }
    
    /**
     * Allows Models to load other Models
     *
     * @param String $ModelName  name of the model
     * @param String $ModelClass custom model name to call (not implemented)
     * 
     * @return void
     */
    public function loadModel($ModelName,$ModelClass=null)
    {
        $ModelNameSpace = "\\Model\\".$ModelName;
        $this->$ModelName = new $ModelNameSpace();
    }
}

