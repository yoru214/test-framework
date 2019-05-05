<?php
namespace Library\Interfaces;

interface UPSShippingInterface {
    public function ShippingFee(object $shippingDetails,object $db);

}