<?php

/**
 * API endpoint to select one Surat Keterangan data 
 * date   : 09 Jan 2021 15:02 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeterangan.php';

    $id = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerSuratKeterangan();
    $db->oneSuratKeterangan($id);
?>