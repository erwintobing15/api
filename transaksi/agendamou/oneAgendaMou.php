<?php

/**
 * API endpoint to select one agenda mou data 
 * date   : 09 Jan 2021 14:17 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerAgendaMou.php';

    $id    = ((isset($_POST["id"])) ? $_POST["id"] : "");

    $db = new DbHandlerAgendaMou();
    $db->oneAgendaMou($id);
?>