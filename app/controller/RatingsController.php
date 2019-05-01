<?php
namespace Controller;

class RatingsController extends AppController
{
    function beforeFilter() : void
    {
        parent::beforeFilter();
    }

    function index() : void
    {
        $this->PAGE_TITLE = "Ratings";
    }

    function view() : void
    {
        $this->PAGE_TITLE = "Product rating";
    }

    function add() : void
    {
        
    }
}
