<?php
namespace Controller;

class ProfileController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->PAGE_TITLE = "Profile";

    }

    function cart()
    {
        $this->VIEW = false;
        $this->loadModel('Cart');
        $cartdata = $this->Cart->getCustomerCart($_SESSION['Auth']->id);
        echo json_encode($cartdata);
        
    }

    function logout()
    {
        $this->VIEW = false;
        unset($_SESSION['Auth']);
        header('Location: /');
    }
}
