<?php 
define('ROOT', str_replace("index.php","",__FILE__));
define('APP', ROOT . 'app');
define('CONFIG', APP . '/config');
define('LIB', APP . '/lib');
require_once 'app/index.php';
