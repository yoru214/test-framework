<?php
/**
 * UPSShipping.php
 * PHP Version 7.2.10
 * 
 * @category Component
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Components\Shipping;
/**
 * UPSShipping Class
 * PHP Version 7.2.10
 * 
 * @category Component
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class UPSShipping  
implements \Library\Interfaces\ProcessShippingInterface,
\Library\Interfaces\UPSShippingInterface
{
    /**
     * Insert shipping fee to purchases table
     *
     * @param object $shippingDetails 
     *                                Shipping Details
     * @param object $db              database connection.
     * 
     * @return void
     */
    public function shippingFee(object $shippingDetails,object $db) : void
    {
        $sql = "INSERT INTO purchases ";
        $sql .= "(customer_id,product_id,quantity,price,shipping) ";
        $sql .= "VALUES (";
        $sql .=  $_SESSION['Auth']->id.", ";
        $sql .= "0, ";
        $sql .= "1, ";
        $sql .= $shippingDetails->fee . ", ";
        $sql .= $shippingDetails->id;
        $sql .= ")";
        $db->query($sql);
    }
    /**
     * Processes Payment including sipping fee.
     *
     * @param integer $id         Id of the logged User.
     * @param object  $db         Database Connection.
     * @param integer $shippingID Id of the shiopment selected.
     * 
     * @return array Returns CODE=>1 if successfull.
     */
    public function process(int $id,object $db,int $shippingID) : array
    {
        $result=array("CODE"=>1,"MESSAGE"=>"Purchase Successful");

        $shippingSQL = "SELECT * FROM shippings WHERE id = {$shippingID}" ;
        $shippingResult = $db->result($shippingSQL);
        $shippingRow=mysqli_fetch_object($shippingResult);


        $sql = "SELECT ";
        $sql .= ($_SESSION['Auth']->funds - $shippingRow->fee);
        $sql .= " - SUM(IFNULL((p.`price`) * (c.quantity),0)) AS 'funds' ";
        $sql .= "FROM carts c ";
        $sql .= "INNER JOIN products p ";
        $sql .= "ON p.id = c.product_id ";
        $sql .= "WHERE c.customer_id = ". $_SESSION['Auth']->id;
        
        $res = $db->result($sql);

        $row=mysqli_fetch_object($res);
        if ($row->funds >= 0)
        {

            $sql = "INSERT INTO purchases ";
            $sql .= "(customer_id,product_id,quantity,price,shipping) ";
            $sql .= "SELECT c.customer_id,c.product_id,c.quantity, p.`price`, ";
            $sql .= $shippingRow->id." as 'shipping' ";
            $sql .= "FROM carts c ";
            $sql .= "INNER JOIN products p ON p.`id` = c.product_id ";
            $sql .= "WHERE ";
            $sql .= "c.customer_id = " . $_SESSION['Auth']->id;


            $db->query($sql);

            $sql = "DELETE from carts where customer_id = ". $_SESSION['Auth']->id;
            $db->query($sql);

            $this->shippingFee($shippingRow, $db);
            
        }
        else
        {
            $result = array("CODE"=>"0","MESSAGE"=>"Insufficient Funds!");
        }

        return $result;
    }
}
