<?php
class Rating extends AppModel
{
   function getProductRating(int $productID)
   {
        $sql = "SELECT CAST((IFNULL(AVG(rate),0)) AS DECIMAL(4,2)) AS 'RATE' FROM ratings WHERE product_id = " . $productID;
        $result = $this->query($sql);
        $row=mysqli_fetch_object($result);
        return $row->RATE;
   }

   function rateProduct(int $productID,int $rating)
   {
        $args = array('conditions'=>array('user_id'=>$_SESSION['Auth']->id,'product_id'=>$productID));
        $res = $this->find($args);
        if(isset($res))
        {
            return false;
        }
        else 
        {
            $sql = "insert into ratings (rate, product_id, user_id, ratedatetime) values (".$rating.",".$productID.",".$_SESSION['Auth']->id.",now())";
            $this->query($sql);
            return true;
        }
   }

   function notRated(int $productID)
   {
       
        $args = array('conditions'=>array('user_id'=>$_SESSION['Auth']->id,'product_id'=>$productID));
        $res = $this->find($args);

        if(isset($res))
        {
            return false;
        }
        else 
        {
            return true;
        }
   }
}
?>