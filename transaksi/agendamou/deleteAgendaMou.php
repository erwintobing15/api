<?php

/**
 * API endpoint to delete agenda mou data
 * created  : 09 Jan 2021 14:16 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerAgendaMou.php';
	$id       = $_POST["id"];

    $db = new DbHandlerAgendaMou();
    $db->deleteAgendaMou($id);
?>