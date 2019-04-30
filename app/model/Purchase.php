<?php
/**
 * Purchase.php
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */

/**
 * Purchase Class
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Model;
class Purchase extends AppModel
{
    /**
     * Purchase all items in cart
     *
     * @param String $shipping Type of shipping selected on purchase.
     * 
     * @return array $array['CODE']=1 if succesful.
     */
    function purchaseFromCart(String $shipping)
    {
        $return = array("CODE"=>"1","MESSAGE"=>"Purchase Successful!");

        $sql = "SELECT ";
        $sql .= $_SESSION['Auth']->funds;
        $sql .= " - SUM(IFNULL((p.`price`) * (c.quantity),0)) AS 'funds' ";
        $sql .= "FROM carts c ";
        $sql .= "INNER JOIN products p ";
        $sql .= "ON p.id = c.product_id ";
        $sql .= "WHERE c.customer_id = ". $_SESSION['Auth']->id;
        
        $result = $this->query($sql);

        $row=mysqli_fetch_object($result);

        if ($row->funds >= 0) {

            $sql = "INSERT INTO purchases ";
            $sql .= "SELECT c.*, p.`price`, ".$shipping." as 'shipping' ";
            $sql .= "FROM carts c ";
            $sql .= "INNER JOIN products p ON p.`id` = c.product_id ";
            $sql .= "WHERE ";
            $sql .= "c.customer_id = " . $_SESSION['Auth']->id;

            $this->query($sql);
            $sql = "DELETE from carts where customer_id = ". $_SESSION['Auth']->id;
            $this->query($sql);
        } else {
            $return = array("CODE"=>"0","MESSAGE"=>"Insufficient Funds!");
        }
        return $return;
    }
}
