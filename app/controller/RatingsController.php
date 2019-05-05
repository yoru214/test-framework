<?php
/**
 * RatingsController.php
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
 * RatingsController Class
 * PHP Version 7.2.10
 * 
 * @category Controller
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class RatingsController extends AppController
{
    /**
     * Index or main page of the Controller
     *
     * @return void
     */
    public function index()
    {
        $this->PAGE_TITLE = "Ratings";
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
}
