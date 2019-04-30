<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once CONFIG . '/config.php';
require_once 'autoload.php';
require_once 'bootloader.php';


new Bootloader($config);