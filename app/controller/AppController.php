<?php
namespace Controller;
class AppController extends \Library\Controller
{

 
    public function __construct()
    {
        parent::__construct();
    }

    public function beforeFilter() : void
    {   
        $this->loadModel('Customer');
        $this->loadModel('Shipping');
        if(!isset($_SESSION['Auth'])) {
            $_SESSION['Auth'] = $this->Customer->add();
        }
        $this->Customer->setFunds();
        $shippings = $this->Shipping->findAll();
        $shippingHTML = "";
        foreach($shippings as $shipping)
        {
            $shippingHTML .= '<input type="radio" name="shipping" value="'.$shipping->id.'" /> '.$shipping->description;
        }
        
        $this->set("Buyer", $_SESSION['Auth']->name);
        $this->set("FUNDS", $_SESSION['Auth']->funds);
        $this->set("SHIPPING_OPTIONS", $shippingHTML);

    }

    public function afterFilter() : void
    {

    }
}
