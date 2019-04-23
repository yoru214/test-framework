<?php
class Purchase extends AppModel
{
    function purchaseFromCart($shipping)
    {
        $sql = "INSERT INTO purchases SELECT c.*, p.`price`, ".$shipping." as 'shipping' FROM carts c INNER JOIN products p ON p.`id` = c.product_id WHERE c.customer_id = " . $_SESSION['Auth']->id;
        $this->query($sql);
        $sql = "DELETE from carts where customer_id = ". $_SESSION['Auth']->id;
        $this->query($sql);
        
    }
}
