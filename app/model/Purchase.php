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
namespace Model;
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
class Purchase extends AppModel
{
    /**
     * Purchase all items in cart
     *
     * @param String $shipping Type of shipping selected on purchase.
     * 
     * @return array $array['CODE']=1 if succesful.
     */
    public function purchaseFromCart($shipping)
    {
        $this->loadModel('Shipping');

        $return = array("CODE"=>"1","MESSAGE"=>"Purchase Successful!");

        $sql = "SELECT ";
        $sql .= $_SESSION['Auth']->funds;
        $sql .= " - SUM(IFNULL((p.`price`) * (c.quantity),0)) AS 'funds' ";
        $sql .= "FROM carts c ";
        $sql .= "INNER JOIN products p ";
        $sql .= "ON p.id = c.product_id ";
        $sql .= "WHERE c.customer_id = ". $_SESSION['Auth']->id;
        
        $result = $this->result($sql);

        $row=mysqli_fetch_object($result);

        $condition = array(
                        'conditions' => array('id'=>$shipping)
                        );
        $shipingDetails = $this->Shipping->find($condition);

        $componentClass 
            = "\\Components\\Shipping\\".$shipingDetails->component_class;
            
        $componentShipping = new $componentClass();
        return $componentShipping->process(
            $_SESSION['Auth']->id,
            $this->getDatabaseConnection(),
            $shipping
        );
    }
}
