<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $port = '3306';

    private $DBConnection;

    var $ERROR = "";

    function __construct($connection = "default")
    {
        require APP . '/config/config.php';
        $this->host=$config['database'][$connection]['host'];
        $this->username=$config['database'][$connection]['username'];
        $this->password=$config['database'][$connection]['password'];
        $this->database=$config['database'][$connection]['database'];
        if(isset($config['database'][$connection]['port']))
        {
            $this->port=$config['database'][$connection]['port'];
        }
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

    function query($queryString)
    {
        $this->DBConnection = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $this->DBConnection->query($queryString);
    }

}