<?php

/**
 * API endpoint to insert agenda mou data
 * date   : 09 Jan 2021 14:16 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerAgendaMou.php';
    
    $no_agenda      = ((isset($_POST["no_agenda"])) ? $_POST["no_agenda"] : "");
    $no_surat       = ((isset($_POST["no_surat"])) ? $_POST["no_surat"] : "");
    $tujuan         = ((isset($_POST["tujuan"])) ? $_POST["tujuan"] : "");
    $isi            = ((isset($_POST["isi"])) ? $_POST["isi"] : "");
    $tgl_surat      = ((isset($_POST["tgl_surat"])) ? $_POST["tgl_surat"] : "");
    $keterangan     = ((isset($_POST["keterangan"])) ? $_POST["keterangan"] : "");
    $id_user        = ((isset($_POST["id_user"])) ? $_POST["id_user"] : "");
    
    $d = new DateTime();
    $tgl_catat = $d->format('Y-m-d');
    
    // file handler
    if($_FILES!=NULL){
        $file     = $_FILES['file']['name'];
        $file_temp= $_FILES['file']['tmp_name'];
    }else{
        $file=NULL;
        $file_temp=NULL;
    }
   
    $db = new DbHandlerAgendaMou();
    $db->insertAgendaMou($no_agenda,$no_surat,$tujuan,$isi,$tgl_surat,$tgl_catat,$keterangan,$id_user,$file,$file_temp);
?>