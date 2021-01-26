<?php

/**
 * API endpoint to update referensi data
 * date : 15 January 2021 05:24
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerReferensi.php';

    $id             = ((isset($_POST["id"])) ? $_POST["id"] : "");
    $kode           = ((isset($_POST["kode"])) ? $_POST["kode"] : "");
    $nama           = ((isset($_POST["nama"])) ? $_POST["nama"] : "");
    $uraian         = ((isset($_POST["uraian"])) ? $_POST["uraian"] : "");
   
    $db = new DbHandlerReferensi();
    $db->updateReferensi($id,$kode,$nama,$uraian);
?>