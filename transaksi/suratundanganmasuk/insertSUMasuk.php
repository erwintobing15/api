<?php

/**
 * Insert surat pengantar keluar data API endpoint 
 * date   : 08 Jan 2021 04:35 pm
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSUMasuk.php';
    
    $no_agenda      = $_POST["no_agenda"];
    $no_surat       = $_POST["no_surat"];
    $asal_surat     = $_POST["asal_surat"];
    $isi            = $_POST["isi"];
    $kode           = $_POST["kode"];
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
   
    $db = new DbHandlerSUMasuk();
    $db->insertSUMasuk($no_agenda,$no_surat,$asal_surat,$isi,$kode,$tgl_surat,$tgl_catat,$keterangan,$id_user,$file,$file_temp);
?>