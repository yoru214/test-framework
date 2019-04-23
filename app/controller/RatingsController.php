<?php

class RatingsController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->PAGE_TITLE = "Ratings";
    }

    function view()
    {
        $this->PAGE_TITLE = "Product rating";
    }

    function add()
    {
        
    }
}