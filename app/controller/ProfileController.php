<?php
namespace Controller;

class ProfileController extends AppController
{
    function beforeFilter() : void
    {
        parent::beforeFilter();
    }

    function index() : void
    {
        $this->PAGE_TITLE = "Profile";

    }

    function cart() : void
    {
        $this->VIEW = false;
        $this->loadModel('Cart');
        $cartdata = $this->Cart->getCustomerCart($_SESSION['Auth']->id);
        echo json_encode($cartdata);
        
    }

    function logout() : void
    {
        $this->VIEW = false;
        unset($_SESSION['Auth']);
        header('Location: /');
    }
}
