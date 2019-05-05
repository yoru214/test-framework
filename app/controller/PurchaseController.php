<?php
/**
 * PurchaseController.php
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
 * PurchaseController Class
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class PurchaseController extends AppController
{
    /**
     * Function that is called before anything in this class.
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('Cart');
        $this->loadModel('Purchase');
    }
    
    /**
     * Index or main page of the Controller
     *
     * @return void
     */
    public function index()
    {
        $this->PAGE_TITLE = "Purchases";
    }

    /**
     * View Page of the Controller
     *
     * @return void
     */
    public function view() 
    {
        $this->PAGE_TITLE = "Product rating";
    }

    /**
     * Add to Cart link
     *
     * @return void
     */
    public function addToCart()
    {
        $this->VIEW = false;
        $this->Cart->addToCart($_SESSION['Auth']->id, $_POST);
    }
    /**
     * Remove to Cart link
     *
     * @return void
     */
    public function removeFromCart()
    {
        $this->VIEW = false;
        $this->Cart->removeFromCart($_SESSION['Auth']->id, $_POST);
    }
    /**
     * Checkout Cart link
     *
     * @return void
     */
    public function checkout()
    {
        $this->VIEW = false;
        echo json_encode($this->Purchase->purchaseFromCart($_POST['shipping']));
        
    }
}
