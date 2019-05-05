<?php
/**
 * Cart.php
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Model;
/**
 * Cart Class
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Cart extends AppModel
{
    /**
     * List all Customer cart contents
     *
     * @param integer $customerID id of the Customer
     * 
     * @return array list of items on the cart.
     */
    public function getCustomerCart(int $customerID) : ?array
    {
        $sql 
            = "SELECT c.*, 
            p.name, 
            p.price, 
            p.image, 
            (p.price * c.quantity) AS 'subtotal', 
            (SELECT 
                (c.`funds` - SUM(IFNULL((p.price * p.quantity),0))
            ) AS 'funds'  
            FROM customers c 
            LEFT JOIN purchases p ON p.`customer_id` = c.id  
            WHERE c.id = " . $customerID . ") AS 'funds'  
            FROM carts c 
            INNER JOIN products p ON p.`id` = c.product_id 
            INNER JOIN customers cu ON cu.id = c.customer_id   
            WHERE c.customer_id = " .$customerID;
        $result = $this->result($sql);


        $object = array();
        $items = array();
        $total= 0.00;
        $qty=0;
        $funds = 0;
        if ($result = $this->result($sql))
        {
            while ($row = mysqli_fetch_object($result))
            {
                $items[] = $row;
                $total += $row->subtotal;
                $qty += $row->quantity;
                $funds = $row->funds;
            }
        }
        $object['total']=number_format($total, 2);
        $object['quantity']=$qty;
        $object['items']=$items;
        if ($funds == 0) {
            $funds = $_SESSION['Auth']->funds;
        }
        $object['funds']=$funds;

        return $object;
    }
    /**
     * Function to add item to cart.
     *
     * @param integer $customerID ID of the customer
     * @param array   $cartData   array details of the item.
     * 
     * @return void
     */
    public function addToCart(int $customerID,array $cartData) : void
    {
        $args = array(
                    "conditions"=>array("customer_id"=>$customerID,
                                        "product_id"=>$cartData['product_id']
                                        )
                    );
        $res = $this->find($args);
        if ($res==null)
        {
            $sql  = "Insert into carts ";
            $sql .= "(customer_id,product_id,quantity) ";
            $sql .= "values ";
            $sql .= "($customerID,".$cartData['product_id'].",".$cartData['qty'].")";
        }
        else
        {
            $sql  = "UPDATE carts set quantity = ";
            $sql .= (intval($res->quantity) + intval($cartData['qty']));
            $sql .= " WHERE id = ".$res->id;
        }

        $this->query($sql);
    }
    /**
     * Function  to remove item from cart
     *
     * @param integer $customerID ID of the Customer
     * @param array   $cartData   array data of the item to be removed
     * 
     * @return void
     */
    public function removeFromCart(int $customerID, array $cartData) : void
    {
        $args = array(
                    "conditions"=>array("customer_id"=>$customerID,
                                        "product_id"=>$cartData['product_id']
                                       )
                    );
        $res = $this->find($args);
        if ($res->quantity==1)
        {
            $sql = "delete from carts WHERE id = ".$res->id;
        }
        else
        {
            $sql  = "UPDATE carts set quantity = " . (intval($res->quantity) - 1);
            $sql .= " WHERE id = ".$res->id;
        }

        $this->query($sql);
    }
}
?>
