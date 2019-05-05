<?php
/**
 * AppController.php
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
 * AppController Class
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class AppController extends \Library\Controller
{
    /**
     * Function that is called before initialization in all class.
     *
     * @return void
     */
    public function beforeFilter()
    {   
        $this->loadModel('Customer');
        $this->loadModel('Shipping');
        if (!isset($_SESSION['Auth']))
        {
            $_SESSION['Auth'] = $this->Customer->add();
        }
        $this->Customer->setFunds();
        $shippings = $this->Shipping->findAll();
        $shippingHTML = "";
        foreach ($shippings as $shipping)
        {
            $shippingHTML .= '<input type="radio" name="shipping" value="';
            $shippingHTML .= $shipping->id.'" /> ';
            $shippingHTML .= $shipping->description;
        }
        
        $this->set("Buyer", $_SESSION['Auth']->name);
        $this->set("FUNDS", $_SESSION['Auth']->funds);
        $this->set("SHIPPING_OPTIONS", $shippingHTML);

    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function afterFilter()
    {

    }
}
