<?php
class Purchase extends AppModel
{
    function purchaseFromCart(String $shipping)
    {
        $return = array("CODE"=>"1","MESSAGE"=>"Purchase Successful!");

        $sql = "SELECT " . $_SESSION['Auth']->funds ." - SUM(IFNULL((p.`price`) * (c.quantity),0)) AS 'funds' FROM carts c INNER JOIN products p ON p.id = c.product_id WHERE c.customer_id = ". $_SESSION['Auth']->id;
        $result = $this->query($sql);

        $row=mysqli_fetch_object($result);

        if($row->funds >= 0)
        {

            $sql = "INSERT INTO purchases SELECT c.*, p.`price`, ".$shipping." as 'shipping' FROM carts c INNER JOIN products p ON p.`id` = c.product_id WHERE c.customer_id = " . $_SESSION['Auth']->id;
            $this->query($sql);
            $sql = "DELETE from carts where customer_id = ". $_SESSION['Auth']->id;
            $this->query($sql);
        }
        else
        {
            $return = array("CODE"=>"0","MESSAGE"=>"Insufficient Funds!");
        }
        


        return $return;
    }
}
