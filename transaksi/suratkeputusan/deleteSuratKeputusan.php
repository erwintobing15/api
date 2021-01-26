<?php

/**
 * API endpoint to delete surat keputusan  
 * created  : 09 Jan 2021 10:29 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeputusan.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerSuratKeputusan();
    $db->deleteSuratKeputusan($id);
?>