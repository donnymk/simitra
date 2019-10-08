<?php
class Model_admin extends CI_Model{

    function cek_admin($username,$password){
        // ambil data user dan password dari tabel admin
        return $this->db->get_where('admin',array('user'=>$username,'password'=>$password));
    }

    function login_admin(){
        return $this->db->get_where('admin',array('user'=>$_SESSION["user_admin"]));
    }

    function tampil_kabkota(){
        //query untuk menampilkan daftar Kab / Kota
        return $this->db->query("SELECT * FROM user WHERE jenis_user <> 'admin'");
    }

    function tampil_user(){
        //query untuk menampilkan daftar Kab / Kota
        return $this->db->query('SELECT * FROM bidang');
    }

    function tampil_admin(){
        //query untuk menampilkan daftar Kab / Kota
        return $this->db->query('SELECT * FROM admin');
    }

    function tampil_pengajuan(){
        //query untuk menampilkan daftar proposal dari Kab / Kota yang di-submit
        return $this->db->query("SELECT *, DATE_FORMAT(tanggal, '%d/%m/%Y') AS pelaksanaan, DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') AS selesai, DATE_FORMAT(tgl_upload, '%d/%m/%Y %T') AS tanggal_upload FROM pengajuan WHERE pengajuan.id_kabkota='".$_SESSION['id_kabkota']."'");
    }

    function tampil_foto_pengajuan(){
        //query untuk menampilkan foto proposal dari Kab / Kota yang dipilih dari daftar pengajuan
        return $this->db->query("SELECT * FROM pengajuan_detail WHERE id_pengajuan='".$_POST['id_pengajuan']."'");
    }

    function jawab_proposal(){
        if(isset($_POST['jawab'])){
            //Buat konfigurasi upload
            //Folder tujuan upload file
            $eror		= false;
            $folder		= 'surat/';
            $tanggal = date("d-m-Y_h.i.s");
            //type file yang bisa diupload
            $file_type	= array('doc','docx');
            //tukuran maximum file yang dapat diupload
            $max_size	= 3000000; // 3MB

        	//Mulai memorises data
            $id_pengajuan=$_POST['id_pengajuan'];
            $ket=$_POST['ket'];
        	$file_name1	= $folder.$tanggal.'_'.$_FILES['surat_rekomendasi']['name'];
        	$file_size1	= $_FILES['surat_rekomendasi']['size'];
        	//cari extensi file dengan menggunakan fungsi explode
        	$explode	= explode('.',$file_name1);
        	$extensi	= $explode[count($explode)-1];

        	//check apakah type file sudah sesuai
        	if(!in_array($extensi,$file_type)){
        		$eror   = true;
        		$pesan  = '<div class="alert alert-danger alert dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Tipe file yang anda upload tidak sesuai. Pastikan tipe file adalah .doc atau .docx
                </div>';
        	}
            //check ukuran file apakah sudah sesuai
        	if($file_size1 > $max_size){
        		$eror   = true;
        		$pesan  = '<div class="alert alert-danger" role="alert">Ukuran file melebihi batas maksimum</div>';
        	}
        	if($eror == true){
        		echo '<div id="eror">'.$pesan.'</div>';
        	}
        	else{
        		//mulai memproses upload file
        		if(move_uploaded_file($_FILES['surat_rekomendasi']['tmp_name'], $file_name1)){
        			//catat nama file ke database
                    $query_update1="UPDATE rekomendasi SET surat='$file_name1', ket='$ket', tgl_terbit=now() WHERE id_pengajuan='$id_pengajuan'";
                    $query_update2="UPDATE pengajuan set status1='dijawab' WHERE id_pengajuan='$id_pengajuan'";

                    $this->db->query($query_update1);
                    $this->db->query($query_update2);
        			echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Surat rekomendasi berhasil diupload.</strong>
                    </div>';
        		} else{
        			echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Upload Gagal, Coba Lagi</div>';
        		}
        	}
        }
    }

    function download_excel($id_pengajuan){
        return $this->db->query("SELECT * FROM dok_peserta WHERE id_pengajuan='$id_pengajuan'");
    }

    function unggah_sttpp_aksi(){
        if(isset($_POST['unggah_sttpp'])){
            //Buat konfigurasi upload
            //Folder tujuan upload file
            $eror = false;
            $folder = 'surat/';
            $tanggal = date("d-m-Y_h.i.s");
            //type file yang bisa diupload
            $file_type = array('xls','xlsx');
            //tukuran maximum file yang dapat diupload
            $max_size = 3000000; // 3MB

        	//Mulai memproses data
            $id_pengajuan = $_POST['idpengajuan'];
        	$file_name1 = $folder.$tanggal.'_'.$_FILES['upload_sttpp']['name'];
        	$file_size1	= $_FILES['upload_sttpp']['size'];
        	//cari extensi file dengan menggunakan fungsi explode
        	$explode = explode('.',$file_name1);
        	$extensi = $explode[count($explode)-1];

        	//check apakah type file sudah sesuai
        	if(!in_array($extensi,$file_type)){
        		$eror   = true;
        		$pesan  = 'Tipe file yang anda unggah tidak sesuai. Tipe file harus .xls atau .xlsx';
        	}
            //check ukuran file apakah sudah sesuai
        	if($file_size1 > $max_size){
        		$eror   = true;
        		$pesan  = 'Ukuran file melebihi batas maksimum';
        	}

            if($eror == true){
        		echo '<div id="eror"><b>'.$pesan.'</b></div>';
        	}

        	else{
        		//mulai memproses upload file
        		if(move_uploaded_file($_FILES['upload_sttpp']['tmp_name'], $file_name1)){
        			//masukkan ke database
                    $this->db->query("INSERT INTO dok_sttpp (id_pengajuan,dok_sttpp,tgl_terbit) VALUES ('$id_pengajuan','$file_name1',now())");
        		}
                else{
        			echo '<div class="alert alert-warning" role="alert">Upload Gagal, Coba Lagi</div>';
        		}
        	}
        }
    }

    function cek_sttpp($id_pengajuan){
        return $this->db->query("SELECT * FROM dok_sttpp WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cari_pengajuan($id_pengajuan){
        return $this->db->query("SELECT proposal, dok_lain FROM pengajuan WHERE id_pengajuan='".$id_pengajuan."'");
    }
    function delete_pengajuan($id_pengajuan){
        return $this->db->query("DELETE from pengajuan WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cari_pengajuan_detail($id_pengajuan){
        return $this->db->query("SELECT foto1, foto2, foto3, foto4, foto5 FROM pengajuan_detail WHERE id_pengajuan='".$id_pengajuan."'");
    }
    function delete_pengajuan_detail($id_pengajuan){
        return $this->db->query("DELETE from pengajuan_detail WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cari_surat_rekomendasi($id_pengajuan){
        return $this->db->query("SELECT surat FROM rekomendasi WHERE id_pengajuan='".$id_pengajuan."'");
    }
    function delete_surat_rekomendasi($id_pengajuan){
        return $this->db->query("DELETE from rekomendasi WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cari_dokpeserta($id_pengajuan){
        return $this->db->query("SELECT dok FROM dok_peserta WHERE id_pengajuan='".$id_pengajuan."'");
    }
    function delete_dokpeserta($id_pengajuan){
        return $this->db->query("DELETE from dok_peserta WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cari_sttpp($id_pengajuan){
        return $this->db->query("SELECT dok_sttpp FROM dok_sttpp WHERE id_pengajuan='".$id_pengajuan."'");
    }
    function delete_sttpp($id_pengajuan){
        return $this->db->query("DELETE FROM dok_sttpp WHERE id_pengajuan='".$id_pengajuan."'");
    }

    function cek_kabkota($kabkota,$namakabkota){
        return $this->db->query("SELECT * FROM kabkota WHERE kabkota='$kabkota $namakabkota'");
    }
    function save_kabkota($nama,$password,$kabkota,$namakabkota){
        return $this->db->query("INSERT INTO kabkota (user,password,kabkota)VALUES ('$nama','$password','$kabkota $namakabkota')");
    }

    function cek_user($user){
        return $this->db->query("SELECT user FROM bidang_teknis WHERE user='$user'");
    }
    function save_user($user,$password,$nama){
        return $this->db->query("INSERT INTO bidang_teknis (user,password,nama)VALUES ('$user','$password','$nama')");
    }

    function update_kabkota($id_kabkota,$user,$password){
        return $this->db->query("UPDATE kabkota SET user='$user', password='$password' WHERE id_kabkota='$id_kabkota'");
    }

    function update_user($id_user,$nama,$user,$password){
        return $this->db->query("UPDATE bidang_teknis SET user='$user', password='$password', nama='$nama' WHERE id_user='$id_user'");
    }

    function update_admin($id_admin,$user,$password){
        return $this->db->query("UPDATE admin SET user='$user', password='$password' WHERE id_admin='$id_admin'");
    }
}