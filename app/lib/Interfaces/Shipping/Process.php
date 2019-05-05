<?php
/**
 * Process.php
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
 * ProcessShippingInterface Interface
 * PHP Version 7.2.10
 * 
 * @category Library
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
interface ProcessShippingInterface
{
    /**
     * Payment Process together woth shipment options
     *
     * @param integer $id         ID of the currently logged User, cart owner.
     * @param object  $db         Database Class of where we intend to connect.
     * @param integer $shippingID id off the shipping type selected.
     * 
     * @return array result in array, CODE 1 if sucess 2 if failed.
     */
    public function process($id,$db,$shippingID);
}
