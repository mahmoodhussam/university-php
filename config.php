<?php
    define('BURL','http://localhost/university/');
    define('BURLA', 'http://localhost/university/admin/');
    define('ASSESTS', 'http://localhost/university/assets/');
    // session statrt
    session_start();
    define('BL',__DIR__);
    define('BLA',__DIR__.'/admin/');
    // connect to database
    require_once(BL.'\functions\db.php');
?>