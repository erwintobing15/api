<?php

/**
 * Fetch all surat pengantar keluar data API endpoint 
 * date   : 07/01/2021
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSPKeluar.php';
    
	$id    = $_POST["id"];
    
    $db = new DbHandlerSPKeluar();
    $db->allSPKeluar($id);
?>