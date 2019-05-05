<?php
/**
 * Database.php
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
 * Database Class
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Database
{
    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_port = '3306';

    private $_DBConnection;

    var $ERROR = "";
    /**
     * Default Constructor sets the default Database based on Config Class.
     *
     * @param String $connection String connection based on Config Class.
     */
    public function __construct(String $connection = "default")
    {
        $dbConfig = new \Config\Database_Config();

        $this->host=$dbConfig->$connection['host'];
        $this->username=$dbConfig->$connection['username'];
        $this->password=$dbConfig->$connection['password'];
        $this->database=$dbConfig->$connection['database'];
        if (isset($dbConfig->$connection['port'])) {
            $this->port=$dbConfig->$connection['port'];
        }

        echo "";
    }
    /**
     * Function to check and connect to database based on Config Class
     *
     * @return void
     */
    public function connect()
    {
        $return = array("CODE"=>1,"MESSAGE"=>"Sucessfully Connected");
        $this->DBConnection 
            = mysqli_connect(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );

        // Check connection
        if (!$this->DBConnection) {
            $this->ERROR = $this->DBConnection->connect_error;
        } 

        return $return;
    }
    /**
     * Function to to send database queries with return values.
     *
     * @param String $queryString String Query
     * 
     * @return object|null Mysql Fetch Ob ject or null if error.
     */
    public function result(String $queryString) : ?object
    {
        $this->DBConnection 
            = new \mysqli(
                $this->host,
                $this->username,
                $this->password, 
                $this->database
            );
        $return = $this->DBConnection->query($queryString);

        return is_bool($return)? null : $return;
    }
    
    /**
     * Function to send queries with no return values
     *
     * @param String $queryString Query String
     * 
     * @return void
     */
    public function query(String $queryString) : void
    {
        $this->DBConnection 
            = new \mysqli(
                $this->host,
                $this->username,
                $this->password, 
                $this->database
            );
            $this->DBConnection->query($queryString);
    }

}
