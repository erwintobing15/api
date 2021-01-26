<?php

/**
 * API endpoint to delete referensi data
 * date : 15 January 2021 05:30 am
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerReferensi.php';
    $id         = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerReferensi();
    $db->deleteReferensi($id);
?>