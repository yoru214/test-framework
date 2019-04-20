<?php
require_once CONFIG . '/config.php';


require_once LIB . '/Controller.php';
require_once LIB . '/Database.php';

require_once APP . '/controller/AppController.php';

class Bootloader
{
    var $route  = array();
    var $segment = array();
    var $databases = array();

    var $PAGE_TITLE = "";
    var $PAGE_CONTENT = "";


    var $Layout = "";
    
    var $VIEW_VARIABLES = array();

    function __construct($config)
    {
        $this->initialize($config);
        $this->loadController();
    }

    function initialize($config)
    {
        if(isset($_GET['route']) && $_GET['route']!='')
        {
            $this->segment = explode('/', ltrim(rtrim($_GET['route'],'/'),'/'));
            if(count($this->segment)<2)
            {
                $this->segment[1]='index';
            }
        }
        else
        {
            $this->segment[0] = $config['routes']['default']['controller'];
            $this->segment[1] = $config['routes']['default']['action'];

            if(!isset($this->segment[1]))
            {
                $this->segment[1]="index";
            }
        }
        $this->route['controller']=$this->segment[0];
        $this->route['action']=$this->segment[1];


        $this->databases=$config["database"];
    }

    function loadController()
    {
        $ControllerFile = APP . '/controller/'.ucfirst($this->route['controller']).'Controller.php';
        require_once $ControllerFile;
        $ControllerClass = ucfirst($this->route['controller']).'Controller';
        $Controller = new $ControllerClass();
        $Controller->ROUTE_SEGMENTS = $this->segment;
        
        foreach($this->databases as $database=>$value)
        {
            $Controller->loadDatabase($database,$value);
        }

        $Controller->beforeFilter();

        if(isset($this->route['action']))
        {
            $Action="".$this->segment[1];
            $Controller->$Action();

            
        }
        else
        {
            $Controller->index();
        }

        $this->defineVariables($Controller);

        $this->loadView();
        $this->setViewVariables();

        $this->loadLayout();
        $this->setLayoutVariables();

        $this->displayLayout();
    }

    function defineVariables($Controller)
    {
        if(isset($Controller->PAGE_TITLE))
        {
            $this->PAGE_TITLE = $Controller->PAGE_TITLE;
        }
        else
        {
            $this->PAGE_TITLE = ucfirst($this->route['controller']);
            if(isset($this->route['action']))
            {
                $this->PAGE_TITLE .= " &middot; " . ucfirst($this->route['action']);
            }

        }

        $this->VIEW_VARIABLES = $Controller->VIEW_VARIABLES;
    }

    function loadLayout()
    {
        $ViewFilePATH = APP . '/view/Layout/default.html';
        $ViewFile = fopen($ViewFilePATH, "r");
        $this->Layout = fread($ViewFile, filesize($ViewFilePATH));
    }

    function setLayoutVariables()
    {
        $this->Layout = str_replace("{{PAGE_TITLE}}",$this->PAGE_TITLE,$this->Layout);
        $this->Layout = str_replace("{{PAGE_CONTENT}}",$this->PAGE_CONTENT,$this->Layout);
    }

    function loadView()
    {
        $ViewFilePATH = APP . '/view/' . ucfirst($this->route['controller']). '/'.$this->route['action'].'.html';
        if(file_exists($ViewFilePATH))
        {
            $ViewFile = fopen($ViewFilePATH, "r");
            $this->PAGE_CONTENT = fread($ViewFile, filesize($ViewFilePATH));
            
            
            
        }
        else {
            die("ERROR: View file \"{$this->route['action']}.html\" not found.");
        }
    }

    function setViewVariables()
    {
        if(isset($this->VIEW_VARIABLES))
        {
            foreach($this->VIEW_VARIABLES as $variable => $value)
            {
                $this->PAGE_CONTENT = str_replace("{{".$variable."}}",$value,$this->PAGE_CONTENT);
            }
        }
    }

    function displayLayout()
    {
        echo $this->Layout;
    }
}


new Bootloader($config);