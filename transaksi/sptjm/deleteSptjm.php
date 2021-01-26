<?php

/**
 * API endpoint to delete SPTJM data
 * created  : 09 Jan 2021 14:29 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSptjm.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");


    $db = new DbHandlerSptjm();
    $db->deleteSptjm($id);
?>