<?php

/**
 * Update surat keluar API endpoint
 * date   : 07/01/2021
 * 
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandlerSuratKeluar.php';

    $id         = ((isset($_POST["id"])) ? $_POST["id"] : "");
    $no_agenda  = ((isset($_POST["no_agenda"])) ? $_POST["no_agenda"] : "");
    $no_surat   = ((isset($_POST["no_surat"])) ? $_POST["no_surat"] : "");
    $tujuan     = ((isset($_POST["tujuan"])) ? $_POST["tujuan"] : "");
    $isi        = ((isset($_POST["isi"])) ? $_POST["isi"] : "");
    $tgl_surat  = ((isset($_POST["tgl_surat"])) ? $_POST["tgl_surat"] : "");
    $keterangan = ((isset($_POST["keterangan"])) ? $_POST["keterangan"] : "");
    
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
   
    $db = new DbHandlerSuratKeluar();
    $db->updateSuratKeluar($id,$no_agenda,$no_surat,$tujuan,$isi,$tgl_surat,$tgl_catat,$keterangan,$file,$file_temp);
?>