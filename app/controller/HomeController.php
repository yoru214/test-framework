<?php

class HomeController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->PAGE_TITLE = "Homepage";

    }

    function test()
    {
        $this->PAGE_TITLE = "Sample";
        $this->set("TEST",$this->segment(5));
        
    }
}