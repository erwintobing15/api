<?php

/**
 * Login API endpoint
 * date : 07 January 2021
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandler.php';
    $username   = $_POST["username"];
    $password   = $_POST["password"];
        
    $db = new DbHandler();
    $db->login($username,$password);
?>