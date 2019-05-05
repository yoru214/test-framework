<?php
/**
 * Database_Config.php
 * PHP Version 7.2.10
 * 
 * @category Config
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Config;
/**
 * Database_Config Class
 * PHP Version 7.2.10
 * 
 * @category Config
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Database_Config
{
    public $default =  array("host"=>"db",
                             "username"=>"root",
                             "password"=>"root",
                             "database"=>"testdb",
                             "port"=>"3306"
                            );
}
