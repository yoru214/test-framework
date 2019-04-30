<?php 
/**
 * Index File Doc Comment.
 * PHP Version 7.2.10
 * 
 * @category File
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */

define('ROOT', str_replace("index.php", "", __FILE__));
define('APP', ROOT . 'app');
define('CONFIG', APP . '/config');
define('LIB', APP . '/lib');
require_once 'app/index.php';
