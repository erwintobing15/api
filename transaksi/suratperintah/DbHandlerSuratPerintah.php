<?php

/**
 * All database handler method for transaksi surat perintah (SuratPerintah) data
 * author       : Erwin Tobing
 * created      : 09 Jan 2021 08:59 am
 * modified     : 
 */

class DbHandlerSuratPerintah
{

    private $conn;
    private $url;

    function __construct()
    {
        require_once '../../../include/koneksi.php';
        $db = new DbConnection();
        $this->conn = $db->connect();
        $this->url = $db->url();
    }

    public function allSuratPerintah($id)
    {
        $sql = "SELECT * FROM tbl_surat_perintah ORDER BY id_surat DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['tujuan']         = $row['tujuan'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['isi']            = $row['isi'];
                $temp['tgl_surat']      = $row['tgl_surat'];	
                $temp['tgl_catat']      = $row['tgl_catat'];
                $temp['file']           = $row['file'];
                $temp['keterangan']     = $row['keterangan'];
				$temp['id_user']        = $row['id_user'];         
                $data[]                 = $temp;
            }
            echo '{"message" : "Berhasil","results":'.json_encode($data).'}';
        } else {
            header('Content-Type: application/json');
            echo '{"results" : "0"}';
        }
    }

    public function oneSuratPerintah($id) 
    {
        $sql = "SELECT * FROM tbl_surat_perintah WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['tujuan']         = $row['tujuan'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['isi']            = $row['isi'];
                $temp['tgl_surat']      = $row['tgl_surat'];	
                $temp['tgl_catat']      = $row['tgl_catat'];
                $temp['file']           = $row['file'];
                $temp['keterangan']     = $row['keterangan'];
				$temp['id_user']        = $row['id_user'];           
                $data                   = $temp;
            }
            echo json_encode($data);
        } else {
            header('Content-Type: application/json');
            echo '{"results" : "0"}';
        }
    }

    public function insertSuratPerintah($no_agenda,$no_surat,$tujuan,$isi,$tgl_surat,
                                      $tgl_catat,$keterangan,$id_user,$file,$file_temp)
    {
        if ($no_agenda==NULL || $no_surat==NULL || $tujuan==NULL || $isi==NULL  || $keterangan==NULL) {
            header('Content-Type: application/json');
            echo '{"message" : "Semua Field Harus Terisi"}';
        }else{   
            $sql = "INSERT INTO tbl_surat_perintah
    				(no_agenda, no_surat, tujuan, isi, tgl_surat, tgl_catat, keterangan, id_user, file) 
    				VALUES ('".$no_agenda."', '".$no_surat."', '".$tujuan."', '".$isi."', 
                    '".$tgl_surat."', '".$tgl_catat."', '".$keterangan."', '".$id_user."', '".$file."')";
            if ($this->conn->query($sql) == TRUE) {
    			move_uploaded_file($file_temp, '../../../upload/surat_lain/'.$file); //upload file
                header('Content-Type: application/json');
                echo '{"message" : "Berhasil Menyimpan"}';
            } else {
                header('Content-Type: application/json');
                echo '{"message" : "Tidak Menyimpan"}';
            }
        }
    }

    public function updateSuratPerintah($id,$no_agenda,$no_surat,$tujuan,$isi,
                    $tgl_surat,$tgl_catat,$keterangan,$file,$file_temp) 
    {
        $sqlcek = "SELECT * FROM tbl_surat_perintah WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek); 
        while ($row = $result->fetch_assoc()) {
            if ($row['file'] != NULL) {
                unlink("../../../upload/surat_lain/".$row['file']); // delete file
            }
        }

        if($file==NULL){
    
             $sql = "UPDATE tbl_surat_perintah 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         tujuan         = '".$tujuan."',
                         isi            = '".$isi."',
                         tgl_surat      = '".$tgl_surat."',
                         tgl_catat      = '".$tgl_catat."',
                         keterangan     = '".$keterangan."'
                     WHERE id_surat = '".$id."'";
 
             if ($this->conn->query($sql) == TRUE) {
                 header('Content-Type: application/json');
                 echo '{"message" : "Berhasil Mengubah"}';
             } else {
                 header('Content-Type: application/json');
                 echo '{"message" : "Tidak Mengubah"}';
             }
 
         }elseif($file!=NULL){
 
             $sql = "UPDATE tbl_surat_perintah 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         tujuan         = '".$tujuan."',
                         isi            = '".$isi."',
                         tgl_surat      = '".$tgl_surat."',
                         tgl_catat      = '".$tgl_catat."',
                         keterangan     = '".$keterangan."',
                         file           = '".$file."'
                     WHERE id_surat = '".$id."'";
                 if ($this->conn->query($sql) == TRUE) {
                     move_uploaded_file($file_temp, '../../../upload/surat_lain/'.$file); //upload file
                     header('Content-Type: application/json');
                     echo '{"message" : "Berhasil Mengubah"}';
                 } else {
                     header('Content-Type: application/json');
                     echo '{"message" : "Tidak Mengubah"}';
                 }
         }
    }

    public function deleteSuratPerintah($id)
    {   
        $sqlcek = "SELECT * FROM tbl_surat_perintah WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek);    
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['file'] != NULL) {
                    unlink("../../../upload/surat_lain/".$row['file']); // delete file
                }
            }

            $sql = "DELETE FROM tbl_surat_perintah WHERE id_surat = '".$id."'";
            $this->conn->query($sql);

            header('Content-Type: application/json');
            echo '{"message" : "Berhasil Menghapus"}';
        } 
        else{
            header('Content-Type: application/json');
            echo '{"message" : "Tidak Menghapus"}';
        }
    }

}

?>