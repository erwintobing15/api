<?php

/**
 * Get all surat masuk data API endpoint
 * created : 07 January 2021
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandler.php';
    
    $id = ((isset($_POST['id']) ? $_POST['id'] : ""));
    
    $db = new DbHandler();
    $db->allSuratMasuk($id);
?>