<?php
/**
 * ProductController.php
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Controller;
/**
 * ProductController Class
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */

class ProductController extends AppController
{
    /**
     * Function that is called before anything in this class.
     *
     * @return void
     */
    public function beforeFilter() : void
    {
        parent::beforeFilter();
        $this->loadModel("Product");
        $this->loadModel("Rating");

        if (isset($_POST['rating']))
        {
            $this->Rating->rateProduct($_POST['product_id'], $_POST['rate']);
           
        }
    }
    /**
     * Page that shows all Products
     *
     * @return void
     */
    public function index() : void
    {
        $this->PAGE_TITLE = "MyStore";

        $products = $this->Product->findAll();

        $result = "";

        foreach ($products as $product)
        {
            $result .= '<li class="col-3">';
            $result .= '<img src="'.$product->image.'" alt="'.$product->name.'" />';
            $result .= '<div class="rating">';
            
            $result .= '<form method="post"  class="rate-product" id="rate-product-';
            $result .= $product->id;
            $result .= '" onsubmit="return rateProduct(this)">';
            
            $result .= '<input type="hidden" name="rating" value="1">';

            $result .= '<input type="hidden" name="product_id"';
            $result .= ' value="'.$product->id.'">';

            $result .= '<h3 style="text-align: center">';
                $productRate = $this->Rating->getProductRating($product->id);
            $result .= number_format(($productRate), 2);
            $result .= '</h3>';

            $result .= '<div class="empty"></div>';

            $result .= '<input type="hidden" name="product"';
            $result .= ' value="'.$product->name.'">';

            $result .= '<button class="rate" style="width:';
            $result .= ($this->Rating->getProductRating($product->id)*30);
            $result .= 'px;" type="button"></button>';

            if ($this->Rating->notRated($product->id)) {
                $result .= '<div>';
                $result .= '    Rate: ';
                $result .= '    <select name="rate" class="rate-options"';
                $result .= '            id="rate_'.$product->id.'">';
                $result .= '        <option value="0"> - </option>';
                $result .= '        <option value="1"> 1 </option>';
                $result .= '        <option value="2"> 2 </option>';
                $result .= '        <option value="3"> 3 </option>';
                $result .= '        <option value="4"> 4 </option>';
                $result .= '        <option value="5"> 5 </option>';
                $result .= '    </select>';
                $result .= '    <button>Submit</button>';
                $result .= '</div>';
            }

            $result .= '</form>';
            $result .= '</div>';
            $result .= '<h3 class="product-description">'.$product->name.'</h3>';
            $result .= '<h3 ">USD '.$product->price.'</h3>';

            $result .= '<a href="/?route=product/view/'.$product->id.'">';
            $result .= '<button class="product-view">View</button>';
            $result .= '</a>';
            
            $result .= '<form  method="POST" action="/?route=purchase/addToCart"';
            $result .= ' class="cart-forms-add">';

            $result .= '<input name="product_id" value = "'.$product->id;
            $result .= '" type="hidden">';

            $result .= '<div class="add-cart-quantity">';
            $result .= '<label>Quantity: </label>';
            $result .= '<button class="quantity-subtract" type="button">-</button>';

            $result .= '<input class="quantity-number"';
            $result .= ' name="qty" type="number" value=1 />';

            $result .= '<button class="quantity-add"  type="button">+</button>';
            $result .= '</div>';
            $result .= '<button class="product-add-cart">Add to Cart</button>';
            
            $result .= '</form>';
            $result .= '</li>';
        }

        $this->set("Products", $result);

    }
    /**
     * Single Product Page
     *
     * @return void
     */
    public function view() : void
    {
        $arg = array('conditions'=>array('id'=>$this->segment(2)));
        $product = $this->Product->find($arg);
        
        $this->PAGE_TITLE = "MyStore &middot; " . $product->name;

        $Rating = $this->Rating->getProductRating($product->id);

        $ratingHTML ="";
        if ($this->Rating->notRated($product->id))
        {
            $ratingHTML  = '<div>';
            $ratingHTML .= '    Rate: ';
            $ratingHTML .= '    <select name="rate">';
            $ratingHTML .= '        <option value="1"> 1 </option>';
            $ratingHTML .= '        <option value="2"> 2 </option>';
            $ratingHTML .= '        <option value="3"> 3 </option>';
            $ratingHTML .= '        <option value="4"> 4 </option>';
            $ratingHTML .= '        <option value="5"> 5 </option>';
            $ratingHTML .= '    </select>';
            $ratingHTML .= '    <button>Submit</button>';
            $ratingHTML .= '</div>';
        }

        $this->set("ProductID", $product->id);
        $this->set("Name", $product->name);
        $this->set("Image", $product->image);
        $this->set("Content", $product->description);
        $this->set("AVGRATE", $Rating);
        $this->set("Rating", $Rating * 30);
        $this->set("RATEDIV", $ratingHTML);
    }

    
}
