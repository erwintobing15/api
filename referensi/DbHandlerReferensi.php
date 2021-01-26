<?php

/**
 * All database handler method for referensi data
 * author       : Erwin Tobing
 * created      : 15 January 2021 04:54 am
 */

class DbHandlerReferensi
{
    private $conn;
    private $url;

    function __construct()
    {
        require_once '../../include/koneksi.php';
        $db = new DbConnection();
        $this->conn = $db->connect();
        $this->url = $db->url();
    }

    public function allReferensi($id)
    {
        $sql = "SELECT * FROM tbl_klasifikasi ORDER BY id_klasifikasi DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['id']             = $row['id_klasifikasi'];
                $temp['kode']           = $row['kode'];
                $temp['nama']           = $row['nama'];
                $temp['uraian']         = $row['uraian'];
                $temp['id_user']        = $row['id_user'];       
                $data[]                 = $temp;
            }
            echo '{"message" : "Berhasil","results":'.json_encode($data).'}';
        } else {
            header('Content-Type: application/json');
            echo '{"results" : "0"}';
        }
    }

    public function oneReferensi($id) 
    {
        $sql = "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi = '".$id."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $temp['message']        = 'Berhasil';
                $temp['id']             = $row['id_klasifikasi'];
                $temp['kode']           = $row['kode'];
                $temp['nama']           = $row['nama'];
                $temp['uraian']         = $row['uraian'];
                $temp['id_user']        = $row['id_user'];         
                $data                   = $temp;
            }
            echo json_encode($data);
        } else {
            header('Content-Type: application/json');
            echo '{"results" : "0"}';
        }
    }

    public function insertReferensi($kode,$nama,$uraian,$id_user)
    {
        if ($kode==NULL || $nama==NULL || $uraian==NULL) {
            header('Content-Type: application/json');
            echo '{"message" : "Semua Field Harus Terisi"}';
        }else{   
            $sql = "INSERT INTO tbl_klasifikasi 
    				(kode, nama, uraian, id_user) 
    				VALUES ('".$kode."', '".$nama."', '".$uraian."', '".$id_user."')";
            if ($this->conn->query($sql) == TRUE) {
                header('Content-Type: application/json');
                echo '{"message" : "Berhasil Menyimpan"}';
            } else {
                header('Content-Type: application/json');
                echo '{"message" : "Tidak Menyimpan"}';
            }
        }
    }

    public function updateReferensi($id,$kode,$nama,$uraian) 
    { 
        $sql = "UPDATE tbl_klasifikasi 
                SET kode           = '".$kode."',
                    nama           = '".$nama."',
                    uraian         = '".$uraian."'
                WHERE id_klasifikasi = '".$id."'";
        if ($this->conn->query($sql) == TRUE) {
            header('Content-Type: application/json');
            echo '{"message" : "Berhasil Mengubah"}';
        } else {
            header('Content-Type: application/json');
            echo '{"message" : "Tidak Mengubah"}';
        }
    }

    public function deleteReferensi($id)
    {   
        $sqlcek = "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi = '".$id."'";
        $result = $this->conn->query($sqlcek);    
        
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM tbl_klasifikasi WHERE id_klasifikasi = '".$id."'";
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