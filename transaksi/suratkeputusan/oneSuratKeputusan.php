<?php

/**
 * API endpoint to select one surat keputusan data 
 * date   : 09 Jan 2021 10:10 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeputusan.php';

    $id = $_POST['id'];

    $db = new DbHandlerSuratKeputusan();
    $db->oneSuratKeputusan($id);
?>