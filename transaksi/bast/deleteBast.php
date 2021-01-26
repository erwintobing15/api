<?php

/**
 * API endpoint to delete BAST data
 * created  : 09 Jan 2021 14:38 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerBast.php';
    
    $id    = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerBast();
    $db->deleteBast($id);
?>