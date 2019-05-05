<?php
/**
 * UPS.php
 * PHP Version 7.2.10
 * 
 * @category Library\Interfaces
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Library\Interfaces;
/**
 * UpsShippingInterface Interface
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
interface UPSShippingInterface
{
    /**
     * Shipping Fee Database Entry required function
     *
     * @param object $shippingDetails mysql shipping details
     * @param object $db              Database connection passed from models
     * 
     * @return void
     */
    public function shippingFee(object $shippingDetails,object $db) : void;

}
