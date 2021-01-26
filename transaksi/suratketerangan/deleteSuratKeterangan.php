<?php

/**
 * API endpoint to delete Surat Keterangan data
 * created  : 09 Jan 2021 15:01 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeterangan.php';
    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerSuratKeterangan();
    $db->deleteSuratKeterangan($id);
?>