<?php

/**
 * All database handler method for transaksi surat undangan masuk (SUMasuk) data
 * author       : Erwin Tobing
 * created      : 08 Jan 2021 01:30 pm
 * modified     : 08 Jan 2021 16:39 pm
 */

class DbHandlerSUMasuk
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

    public function allSUMasuk($id)
    {
        $sql = "SELECT * FROM tbl_su_masuk ORDER BY id_surat DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['asal_surat']     = $row['asal_surat'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['isi']            = $row['isi'];
                $temp['kode']           = $row['kode'];
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

    public function oneSUMasuk($id) 
    {
        $sql = "SELECT * FROM tbl_su_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['asal_surat']     = $row['asal_surat'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['isi']            = $row['isi'];
                $temp['kode']           = $row['kode'];
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

    public function insertSUMasuk($no_agenda,$no_surat,$asal_surat,$isi,$kode, $tgl_surat,
                                      $tgl_catat,$keterangan,$id_user,$file,$file_temp)
    {
        if ($no_agenda==NULL || $no_surat==NULL || $asal_surat==NULL || $isi==NULL  || $keterangan==NULL) {
            header('Content-Type: application/json');
            echo '{"message" : "Semua Field Harus Terisi"}';
        }else{   
            $sql = "INSERT INTO tbl_su_masuk
    				(no_agenda, no_surat, asal_surat, isi, kode, tgl_surat, tgl_catat, keterangan, id_user, file) 
    				VALUES ('".$no_agenda."', '".$no_surat."', '".$asal_surat."', '".$isi."', '".$kode."',
                    '".$tgl_surat."', '".$tgl_catat."', '".$keterangan."', '".$id_user."', '".$file."')";
            if ($this->conn->query($sql) == TRUE) {
    			move_uploaded_file($file_temp, '../../../upload/su_masuk/'.$file); //upload file
                header('Content-Type: application/json');
                echo '{"message" : "Berhasil Menyimpan"}';
            } else {
                header('Content-Type: application/json');
                echo '{"message" : "Tidak Menyimpan"}';
            }
        }
    }

    public function updateSUMasuk($id,$no_agenda,$no_surat,$asal_surat,$isi,$kode,
                    $tgl_surat,$tgl_catat,$keterangan,$file,$file_temp) 
    {
        $sqlcek = "SELECT * FROM tbl_su_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek); 
        while ($row = $result->fetch_assoc()) {
            if ($row['file'] != NULL) {
                unlink("../../../upload/su_masuk/".$row['file']); // delete file
            }
        }

        if($file==NULL){
    
             $sql = "UPDATE tbl_su_masuk 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         asal_surat     = '".$asal_surat."',
                         isi            = '".$isi."',
                         kode           = '".$kode."',
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
 
             $sql = "UPDATE tbl_su_masuk 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         asal_surat     = '".$asal_surat."',
                         isi            = '".$isi."',
                         kode           = '".$kode."',
                         tgl_surat      = '".$tgl_surat."',
                         tgl_catat      = '".$tgl_catat."',
                         keterangan     = '".$keterangan."',
                         file           = '".$file."'
                     WHERE id_surat = '".$id."'";
                 if ($this->conn->query($sql) == TRUE) {
                     move_uploaded_file($file_temp, '../../../upload/su_masuk/'.$file); //upload file
                     header('Content-Type: application/json');
                     echo '{"message" : "Berhasil Mengubah"}';
                 } else {
                     header('Content-Type: application/json');
                     echo '{"message" : "Tidak Mengubah"}';
                 }
         }
    }

    public function deleteSUMasuk($id)
    {   
        $sqlcek = "SELECT * FROM tbl_su_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek);    
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['file'] != NULL) {
                    unlink("../../../upload/su_masuk/".$row['file']); // delete file
                }
            }

            $sql = "DELETE FROM tbl_su_masuk WHERE id_surat = '".$id."'";
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