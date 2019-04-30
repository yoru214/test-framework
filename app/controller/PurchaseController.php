<?php

class PurchaseController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('Cart');
        $this->loadModel('Purchase');
    }

    function index()
    {
        $this->PAGE_TITLE = "Purchases";
    }

    function view()
    {
        $this->PAGE_TITLE = "Product rating";
    }

    function addToCart()
    {
        $this->VIEW = false;
        $this->Cart->addToCart($_SESSION['Auth']->id, $_POST);
    }
    function removeFromCart()
    {
        $this->VIEW = false;
        $this->Cart->removeFromCart($_SESSION['Auth']->id, $_POST);
    }
    function checkout()
    {
        $this->VIEW = false;
        echo json_encode($this->Purchase->purchaseFromCart($_POST['shipping']));
        
    }
}
