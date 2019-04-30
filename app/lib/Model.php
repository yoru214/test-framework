<?php
class Model 
{
    var $TABLE = "";
    var $DB = "";
    var $ERROR_MESSAGE = "";

    private $CONFIG = array();
    private $DBConnection;
    function __construct()
    {
        $this->TABLE = $this->pluralize(strtolower(get_class($this)));
        $this->DB = 'default';

        $config = array();
        
        $dbConfig = new Database_Config();
        $databases = get_object_vars($dbConfig);
        $config['database']=$databases;


        $this->CONFIG = $config['database'];
    }

    function findAll(array $arguments = array())
    {
        $this->DBConnection =  new Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        if($ConnectionStatus["CODE"]=="1")
        {
            $where = "";
            if(count($arguments)>0)
            {
                if(isset($arguments['conditions']))
                {
                    var_dump($arguments['conditions']);
                }
            }   
            $sql = "select * from " . $this->TABLE;
            $result = $this->DBConnection->query($sql);

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

    function find(array $arguments = array())
    {
        $this->DBConnection =  new Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        if($ConnectionStatus["CODE"]=="1")
        {
            $sql = "select * from " . $this->TABLE;
            $where = "";
            if(count($arguments)>0)
            {
                if(isset($arguments['conditions']))
                {
                    $sql .= " where ";
                    $cnt = 0;
                    foreach($arguments['conditions'] as $field => $value)
                    {
                        if($cnt>0)
                        {
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

            $result = $this->DBConnection->query($sql);
            return mysqli_fetch_object($result);
        }
        else
        {
            $this->ERROR_MESSAGE = $ConnectionStatus['MESSAGE'];
            return null;
        }
    }

    function query(String $sqlQuery)
    {
        $this->DBConnection =  new Database($this->DB);
        $ConnectionStatus = $this->DBConnection->connect();

        return $this->DBConnection->query($sqlQuery);
    }

    function pluralize(String $string)
    {
        $lastChar = substr($string, -1);

        if($lastChar == "s")
        {
            $string .= "ses";
        }
        else
        {
            $string .= "s";
        }

        return $string;
    }
}

