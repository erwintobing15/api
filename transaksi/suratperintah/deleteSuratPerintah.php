<?php

/**
 * API endpoint to delete surat perintah 
 * created  : 09 Jan 2021 09:42 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratPerintah.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerSuratPerintah();
    $db->deleteSuratPerintah($id);
?>