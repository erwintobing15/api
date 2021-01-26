<?php

/**
 * All database handler method for user and surat masuk data
 * author   : Erwin Tobing
 * date     : 07 January 2021
 */

class DbHandler
{
    private $conn;
    private $url;

    function __construct()
    {
        require_once '../include/koneksi.php';
        $db = new DbConnection();
        $this->conn = $db->connect();
        $this->url = $db->url();
    }

    /*
        All database handler method for user
    */

    public function login($username,$password)
    {
        $sql = "SELECT * FROM tbl_user WHERE 
                username='".$username."' AND 
                password='".md5($password)."'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            $row = $result->fetch_assoc();

            $temp['id']         = $row['id_user'];
            $temp['username']   = $row['username'];
            $temp['password']   = $row['password'];
            $temp['nama']       = $row['nama'];
            $temp['nip']        = $row['nip'];
            $temp['admin']      = $row['admin'];          
            $data[]             = $temp;

            echo '{ "message" : "Berhasil" ,"results":'.json_encode($data).'}';
        } else {
            header('Content-Type: application/json');
            echo '{"message" : "Username atau password salah"}';
        }
    }

    public function allUser($id)
    {
        $sql = "SELECT * FROM tbl_user WHERE id_user != '".$id."' ORDER BY id_user DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_user'];
                $temp['username']       = $row['username'];
                $temp['password']       = $row['password'];
                $temp['nama']           = $row['nama'];
                $temp['nip']            = $row['nip'];
                $temp['admin']          = $row['admin'];       
                $data[]                 = $temp;
            }
            echo '{"message" : "Berhasil","results":'.json_encode($data).'}';
        } else {
            header('Content-Type: application/json');
            echo '{"results" : "0"}';
        }
    }

    /*
        All database handler method for transaksi surat masuk
    */

    public function allSuratMasuk($id)
    {
        $sql = "SELECT * FROM tbl_surat_masuk WHERE id_surat!='".$id."' ORDER BY id_surat DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['asal_surat']     = $row['asal_surat'];
                $temp['isi']            = $row['isi'];
                $temp['kode']           = $row['kode'];
                $temp['indeks']         = $row['indeks'];
                $temp['tgl_surat']      = $row['tgl_surat'];	
                $temp['tgl_diterima']   = $row['tgl_diterima'];
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

    public function oneSuratMasuk($id) 
    {
        $sql = "SELECT * FROM tbl_surat_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['message']        = 'Berhasil';
                $temp['id']             = $row['id_surat'];
                $temp['no_agenda']      = $row['no_agenda'];
                $temp['no_surat']       = $row['no_surat'];
                $temp['asal_surat']     = $row['asal_surat'];
                $temp['isi']            = $row['isi'];
                $temp['kode']           = $row['kode'];
                $temp['indeks']         = $row['indeks'];
                $temp['tgl_surat']      = $row['tgl_surat'];	
                $temp['tgl_diterima']   = $row['tgl_diterima'];
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

    public function insertSuratMasuk($no_agenda,$no_surat,$asal_surat,$isi,$kode,$indeks,
                                    $tgl_surat,$tgl_diterima,$keterangan,$id_user,$file,$file_temp)
    {
      if ($no_agenda==NULL || $no_surat==NULL || $asal_surat==NULL || $isi==NULL || $kode==NULL || $indeks==NULL || 
             $keterangan==NULL) {
            header('Content-Type: application/json');
            echo '{"message" : "Semua Field Harus Terisi"}';
        }else{   
            $sql = "INSERT INTO tbl_surat_masuk 
    				(no_agenda, no_surat, asal_surat, isi, kode, indeks, tgl_surat, tgl_diterima, keterangan, id_user, file) 
    				VALUES ('".$no_agenda."', '".$no_surat."', '".$asal_surat."', '".$isi."', '".$kode."', '".$indeks."',
                     '".$tgl_surat."', '".$tgl_diterima."', '".$keterangan."', '".$id_user."', '".$file."')";
            if ($this->conn->query($sql) == TRUE) {
    			move_uploaded_file($file_temp, '../upload/surat_masuk/'.$file); //upload file
                header('Content-Type: application/json');
                echo '{"message" : "Berhasil Menyimpan"}';
            } else {
                header('Content-Type: application/json');
                echo '{"message" : "Tidak Menyimpan"}';
            }
        }
    }

    public function updateSuratMasuk($id,$no_agenda,$no_surat,$asal_surat,$isi,$kode,$indeks,
                                    $tgl_surat,$tgl_diterima,$keterangan,$id_user,$file,$file_temp) 
    {
        $sqlcek = "SELECT * FROM tbl_surat_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek); 
        while ($row = $result->fetch_assoc()) {
            if ($row['file'] != NULL) {
                unlink("../upload/surat_masuk/".$row['file']); // delete file
            }
        }

        if($file==NULL){
            /* header('Content-Type: application/json');
             echo '{"message" :"File tidak ada"}';
            */
    
             $sql = "UPDATE tbl_surat_masuk 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         asal_surat     = '".$asal_surat."',
                         isi            = '".$isi."',
                         kode           = '".$kode."',
                         indeks         = '".$indeks."',
                         tgl_surat      = '".$tgl_surat."',
                         tgl_diterima   = '".$tgl_diterima."',
                         keterangan     = '".$keterangan."',
                         id_user        = '".$id_user."'
                     WHERE id_surat = '".$id."'";
 
             if ($this->conn->query($sql) == TRUE) {
                 header('Content-Type: application/json');
                 echo '{"message" : "Berhasil Mengubah"}';
             } else {
                 header('Content-Type: application/json');
                 echo '{"message" : "Tidak Mengubah"}';
             }
 
         }elseif($file!=NULL){
             /*header('Content-Type: application/json');
             echo '{"message" :"File ada"}';*/
 
             $sql = "UPDATE tbl_surat_masuk 
                     SET no_agenda      = '".$no_agenda."',
                         no_surat       = '".$no_surat."',
                         asal_surat     = '".$asal_surat."',
                         isi            = '".$isi."',
                         kode           = '".$kode."',
                         indeks         = '".$indeks."',
                         tgl_surat      = '".$tgl_surat."',
                         tgl_diterima   = '".$tgl_diterima."',
                         keterangan     = '".$keterangan."',
                         file           = '".$file."',
                         id_user        = '".$id_user."'
                     WHERE id_surat = '".$id."'";
                 if ($this->conn->query($sql) == TRUE) {
                     move_uploaded_file($file_temp, '../upload/surat_masuk/'.$file); //upload file
                     header('Content-Type: application/json');
                     echo '{"message" : "Berhasil Mengubah"}';
                 } else {
                     header('Content-Type: application/json');
                     echo '{"message" : "Tidak Mengubah"}';
                 }
         }
    }

    public function deleteSuratMasuk($id)
    {   
        $sqlcek = "SELECT * FROM tbl_surat_masuk WHERE id_surat = '".$id."'";
        $result = $this->conn->query($sqlcek);    
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['file'] != NULL) {
                    unlink("../upload/surat_masuk/".$row['file']); // delete file
                }
            }

            $sql = "DELETE FROM tbl_surat_masuk WHERE id_surat = '".$id."'";
            $this->conn->query($sql);

            header('Content-Type: application/json');
            echo '{"message" : "Berhasil Menghapus"}';
        }else{
            header('Content-Type: application/json');
            echo '{"message" : "Tidak Menghapus"}';
        }
    }

}

?>