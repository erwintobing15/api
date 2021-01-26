<?php

/**
 * API endpoint to delete surat keputusan  
 * created  : 09 Jan 2021 11:02 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerNodin.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerNodin();
    $db->deleteNodin($id);
?>