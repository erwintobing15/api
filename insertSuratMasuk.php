<?php

/**
 * Insert surat masuk API endpoint
 * date : 07 January 2021
 */

    error_reporting(-1);
    ini_set('display_errors', 'On');
    date_default_timezone_set('Asia/Jakarta');

    require_once 'DbHandler.php';
    
    $no_agenda      = ((isset($_POST['no_agenda']) ? $_POST['no_agenda'] : ""));
    $no_surat       = ((isset($_POST['no_surat']) ? $_POST['no_surat'] : ""));
    $asal_surat     = ((isset($_POST['asal_surat']) ? $_POST['asal_surat'] : ""));
    $isi            = ((isset($_POST['isi']) ? $_POST['isi'] : ""));
    $kode           = ((isset($_POST['kode']) ? $_POST['kode'] : ""));
    $indeks         = ((isset($_POST['indeks']) ? $_POST['indeks'] : ""));
    $tgl_surat      = ((isset($_POST['tgl_surat']) ? $_POST['tgl_surat'] : ""));
    $keterangan     = ((isset($_POST['keterangan']) ? $_POST['keterangan'] : ""));
    $id_user        = ((isset($_POST['id_user']) ? $_POST['id_user'] : ""));

    $d = new DateTime();
    $tgl_diterima = $d->format('Y-m-d');
    
    // file handler
    if($_FILES!=NULL){
        $file     = $_FILES['file']['name'];
        $file_temp= $_FILES['file']['tmp_name'];
    }else{
        $file=NULL;
        $file_temp=NULL;
    }
   
    $db = new DbHandler();
    $db->insertSuratMasuk($no_agenda,$no_surat,$asal_surat,$isi,$kode,$indeks,$tgl_surat,$tgl_diterima,$keterangan,$id_user,$file,$file_temp);
?>