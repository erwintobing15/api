<?php

/**
 * API endpoint to insert referensi data
 * date : 15 January 2021 05:17 am
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerReferensi.php';

    $kode           = ((isset($_POST["kode"])) ? $_POST["kode"] : "");
    $nama           = ((isset($_POST["nama"])) ? $_POST["nama"] : "");
    $uraian         = ((isset($_POST["uraian"])) ? $_POST["uraian"] : "");
    $id_user        = ((isset($_POST["id_user"])) ? $_POST["id_user"] : "");
   
    $db = new DbHandlerReferensi();
    $db->insertReferensi($kode,$nama,$uraian,$id_user);
?>