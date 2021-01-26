<?php

/**
 * API endpoint to delete perjanjian kerjasama data
 * created  : 09 Jan 2021 11:36 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerPerjanjianKerjasama.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerPerjanjianKerjasama();
    $db->deletePerjanjianKerjasama($id);
?>