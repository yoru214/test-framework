<?php

class AppController extends Controller
{
    function beforeFilter()
    {   
        $this->loadModel('Customer');
        if(!isset($_SESSION['Auth']))
        {
            $_SESSION['Auth'] = $this->Customer->add();
        }
        $this->Customer->setFunds();
        $this->set("Buyer",$_SESSION['Auth']->name);
        $this->set("FUNDS",$_SESSION['Auth']->funds);
    }

    function afterFilter()
    {

    }
}