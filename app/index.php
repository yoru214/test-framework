<?php
/**
 * Main file of the App (index.php)
 * PHP Version 7.2.10
 * 
 * @category Global
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
declare(strict_types=1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once CONFIG . '/config.php';
require_once 'autoload.php';
require_once 'bootloader.php';


new Bootloader($config);
