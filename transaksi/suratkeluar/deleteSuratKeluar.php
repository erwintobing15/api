<?php

/**
 * Delete surat keluar data API endpoint
 * date   : 07/01/2021
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeluar.php';
	$id       = $_POST["id"];

    $db = new DbHandlerSuratKeluar();
    $db->deleteSuratKeluar($id);
?>