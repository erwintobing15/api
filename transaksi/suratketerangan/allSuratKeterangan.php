<?php

/**
 * API endpoint to fetch all Surat Keterangan data 
 * created   : 09 Jan 2021 15:01 PM
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeterangan.php';
    
	$id    = $_POST["id"];
    
    $db = new DbHandlerSuratKeterangan();
    $db->allSuratKeterangan($id);
?>