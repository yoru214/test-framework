<?php
namespace Library;
class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $port = '3306';

    private $DBConnection;

    var $ERROR = "";

    function __construct(String $connection = "default")
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

    function connect()
    {
        $return = array("CODE"=>1,"MESSAGE"=>"Sucessfully Connected");
        $this->DBConnection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        // Check connection
        if (!$this->DBConnection) {
            $this->ERROR = $this->DBConnection->connect_error;
        } 

        return $return;
    }

    function query(String $queryString) 
    {
        $this->DBConnection 
            = new \mysqli(
                $this->host,
                $this->username,
                $this->password, 
                $this->database
            );
        return $this->DBConnection->query($queryString);
    }

}
