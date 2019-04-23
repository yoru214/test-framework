<?php
class Cart extends AppModel
{
   function getCustomerCart($customerID)
   {
        $sql = "SELECT c.*, p.name, p.price, p.image, (p.price * c.quantity) AS 'subtotal', (SELECT (c.`funds` - SUM(IFNULL((p.price * p.quantity),0))) AS 'funds'  FROM customers c LEFT JOIN purchases p ON p.`customer_id` = c.id  WHERE c.id = " . $customerID . ") AS 'funds'  FROM carts c INNER JOIN products p ON p.`id` = c.product_id INNER JOIN customers cu ON cu.id = c.customer_id   WHERE c.customer_id = " .$customerID;
        $result = $this->query($sql);


        $object = array();
        $items = array();
        $total= 0.00;
        $qty=0;
        $funds = 0;
        if($result = $this->query($sql))
        {
            while ($row = mysqli_fetch_object($result)) {
                $items[] = $row;
                $total += $row->subtotal;
                $qty += $row->quantity;
                $funds = $row->funds;
            }
        }
        $object['total']=number_format($total,2);
        $object['quantity']=$qty;
        $object['items']=$items;
        if($funds == 0)
        {
            $funds = $_SESSION['Auth']->funds;
        }
        $object['funds']=$funds;

        return $object;
   }

   function addToCart($customerID,$cartData)
   {
        $args = array("conditions"=>array("customer_id"=>$customerID,"product_id"=>$cartData['product_id']));
        $res = $this->find($args);
        if($res==null)
        {
            $sql = "Insert into carts (customer_id,product_id,quantity) values($customerID," .$cartData['product_id'].",".$cartData['qty'].")";
        }
        else {
            $sql = "UPDATE carts set quantity = " . (intval($res->quantity) + intval($cartData['qty'])) . " WHERE id = ".$res->id;
        }
        $this->query($sql);
   }

   function removeFromCart($customerID,$cartData)
   {
        $args = array("conditions"=>array("customer_id"=>$customerID,"product_id"=>$cartData['product_id']));
        $res = $this->find($args);
        if($res->quantity==1)
        {
            $sql = "delete from carts WHERE id = ".$res->id;
        }
        else {
            $sql = "UPDATE carts set quantity = " . (intval($res->quantity) - 1) . " WHERE id = ".$res->id;
        }

        $this->query($sql);
   }
}
?>