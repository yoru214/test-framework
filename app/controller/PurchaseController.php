<?php
namespace Controller;

class PurchaseController extends AppController
{
    function beforeFilter() : void
    {
        parent::beforeFilter();
        $this->loadModel('Cart');
        $this->loadModel('Purchase');
    }

    function index() : void
    {
        $this->PAGE_TITLE = "Purchases";
    }

    function view() : void
    {
        $this->PAGE_TITLE = "Product rating";
    }

    function addToCart() : void
    {
        $this->VIEW = false;
        $this->Cart->addToCart($_SESSION['Auth']->id, $_POST);
    }
    function removeFromCart() : void
    {
        $this->VIEW = false;
        $this->Cart->removeFromCart($_SESSION['Auth']->id, $_POST);
    }
    function checkout() : void
    {
        $this->VIEW = false;
        echo json_encode($this->Purchase->purchaseFromCart($_POST['shipping']));
        
    }
}
