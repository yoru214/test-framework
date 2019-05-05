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
    private $host;
    private $username;
    private $password;
    private $database;
    private $port = '3306';

    private $_DBConnection;

    var $ERROR = "";
    /**
     * Default Constructor sets the default Database based on Config Class.
     *
     * @param String $connection String connection based on Config Class.
     */
    public function __construct($connection = null)
    {
        if($connection == null)
        {
            $connection = "default";
        }
        $dbConfig = new \Config\Database_Config();

        $conf =$dbConfig->$connection;

        $this->host=$conf['host'];
        $this->username=$conf['username'];
        $this->password=$conf['password'];
        $this->database=$conf['database'];
        if (isset($conf['port'])) 
        {
            $this->port=$conf['port'];
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
    public function result($queryString)
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
    public function query($queryString)
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
