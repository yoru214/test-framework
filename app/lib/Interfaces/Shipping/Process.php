<?php
namespace Library\Interfaces;

interface ProcessShippingInterface {
    public function process(int $id,object $db,int $shippingID) : array;
}