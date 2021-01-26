<?php

/**
 * Insert surat pengantar keluar data API endpoint 
 * date   : 08 Jan 2021 10:08 am
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSPKeluar.php';
    
    $no_agenda      = $_POST["no_agenda"];
    $no_surat       = $_POST["no_surat"];
    $tujuan         = $_POST["tujuan"];
    $isi            = $_POST["isi"];
    $tgl_surat      = $_POST["tgl_surat"];	
    $keterangan     = $_POST["keterangan"];
    $id_user        = $_POST["id_user"];   
    
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
   
    $db = new DbHandlerSPKeluar();
    $db->insertSPKeluar($no_agenda,$no_surat,$tujuan,$isi,$tgl_surat,$tgl_catat,$keterangan,$id_user,$file,$file_temp);
?>