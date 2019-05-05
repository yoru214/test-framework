<?php
/**
 * ProfileController.php
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
 * ProfileController Class
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */

class ProfileController extends AppController
{

    /**
     * Index or main page of the Controller
     *
     * @return void
     */
    public function index() : void
    {
        $this->PAGE_TITLE = "Profile";

    }

    /**
     * Function that generates the cart details of the logged user.
     *
     * @return void
     */
    public function cart() : void
    {
        $this->VIEW = false;
        $this->loadModel('Cart');
        $cartdata = $this->Cart->getCustomerCart($_SESSION['Auth']->id);
        echo json_encode($cartdata);
        
    }
    /**
     * Logout link of the Store
     *
     * @return void
     */
    public function logout() : void
    {
        $this->VIEW = false;
        unset($_SESSION['Auth']);
        header('Location: /');
    }
}
