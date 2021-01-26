<?php

/**
 * API endpoint to fetch all surat keputusan data 
 * created   : 09 Jan 2021 09:06 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeputusan.php';
    
	$id    = $_POST["id"];
    
    $db = new DbHandlerSuratKeputusan();
    $db->allSuratKeputusan($id);
?>