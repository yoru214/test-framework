<?php
/**
 * Rating.php
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
 * Rating Class
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Rating extends AppModel
{
    /**
     * Gets the rating of the product given the selected Product ID
     *
     * @param integer $productID id of the Product
     * 
     * @return float Average rating of the Product 
     */
    function getProductRating(int $productID) : float
    {
        $sql  = "SELECT ";
        $sql .= "CAST((IFNULL(AVG(rate),0)) AS DECIMAL(4,2)) AS 'RATE' ";
        $sql .= "FROM ratings ";
        $sql .= "WHERE product_id = " . $productID;
        $result = $this->result($sql);
        $row=mysqli_fetch_object($result);
        return $row->RATE;
    }
    /**
     * Function that records the product Rating
     *
     * @param integer $productID Id of the product to be rated.
     * @param integer $rating    Rate of the Product.
     * 
     * @return boolean returns true if rating is sucessful.
     */
    function rateProduct(int $productID,int $rating) : bool
    {
        $args = array(
                      'conditions'=>array('user_id'=>$_SESSION['Auth']->id,
                                          'product_id'=>$productID
                                         )
                        );
        $res = $this->find($args);
        if (isset($res)) {
            return false;
        } else {
            $sql  = "insert into ratings ";
            $sql .= "(rate, product_id, user_id, ratedatetime) ";
            $sql .= "values ";
            $sql .= "(".$rating.",".$productID.",".$_SESSION['Auth']->id.",now())";
            $this->query($sql);
            return true;
        }
    }
    /**
     * Function to check if user had already rated the selected product.
     *
     * @param integer $productID ID of the product.
     * 
     * @return boolean returns true if user is still eligible to rate.
     */
    function notRated(int $productID) : bool
    {
        $args = array(
                    'conditions'=>array('user_id'=>$_SESSION['Auth']->id,
                                        'product_id'=>$productID
                                        )
                    );
        $res = $this->find($args);
        return !isset($res);
    }
}
?>
