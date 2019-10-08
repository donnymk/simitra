<?php
class Model_user extends CI_Model{

    function cek_user_bidang($username,$password){
        // ambil data user dan password dari tabel bidang
        return $this->db->get_where('bidang',array('user'=>$username,'password'=>$password));
    }

    function login_user(){
        return $this->db->get_where('bidang',array('user'=>$_SESSION["user_bidang"]));
    }
    
// -----------------------------------------------------------------------------
// PENGAJUAN PROPOSAL
// -----------------------------------------------------------------------------

    function tampil_kabkota(){
        //query untuk menampilkan daftar Kab / Kota
        return $this->db->query("SELECT * FROM user WHERE jenis_user <> 'admin' AND jenis_user = 'KABKOT'");
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
    
// -----------------------------------------------------------------------------
// USULAN UJI KOMPETENSI
// -----------------------------------------------------------------------------
    function lihat_usulanujikomp(){
        // ambil data
        $kolom = ['ujikom_usulan_ujikom.id_usulan_ujikom',
            'ujikom_jenis_ujikom.jenis_ujikom',
            'ujikom_nama_jabatan.nama_jabatan',
            'ujikom_penjenjangan.nama_jenjang',
            'ujikom_usulan_ujikom.jumlah_peserta',
            'ujikom_usulan_ujikom.tgl_usul',
            'user.nama AS kabupatenkota'];
        $this->db->select($kolom);
        $this->db->from('ujikom_usulan_ujikom');  
        $this->db->join('ujikom_jenis_ujikom', 'ujikom_usulan_ujikom.id_jenis_ujikom = ujikom_jenis_ujikom.id_jenis_ujikom');
        $this->db->join('ujikom_nama_jabatan', 'ujikom_usulan_ujikom.id_jabatan = ujikom_nama_jabatan.id_jabatan');
        $this->db->join('ujikom_penjenjangan', 'ujikom_usulan_ujikom.id_penjenjangan = ujikom_penjenjangan.id_penjenjangan', 'left');
        $this->db->join('user', 'ujikom_usulan_ujikom.id_user = user.id');
        return $this->db->get();
    }
    
    function lihat_jft(){
        // ambil data
        $kolom = ['ujikom_usulan_ujikom.id_usulan_ujikom',
            'ujikom_jenis_ujikom.jenis_ujikom',
            'ujikom_nama_jabatan.nama_jabatan',
            'ujikom_penjenjangan.nama_jenjang',
            'ujikom_usulan_ujikom.jumlah_peserta',
            'ujikom_usulan_ujikom.tgl_usul',
            'user.nama AS kabupatenkota'];
        $this->db->select($kolom);
        $this->db->from('ujikom_usulan_ujikom');  
        $this->db->join('ujikom_jenis_ujikom', 'ujikom_usulan_ujikom.id_jenis_ujikom = ujikom_jenis_ujikom.id_jenis_ujikom');
        $this->db->join('ujikom_nama_jabatan', 'ujikom_usulan_ujikom.id_jabatan = ujikom_nama_jabatan.id_jabatan');
        $this->db->join('ujikom_penjenjangan', 'ujikom_usulan_ujikom.id_penjenjangan = ujikom_penjenjangan.id_penjenjangan');
        $this->db->join('user', 'ujikom_usulan_ujikom.id_user = user.id');
        return $this->db->get();
    }
    
    function load_jabatannjenjang($jenisujikomp){
        // ambil data
        $kolom = ['ujikom_nama_jabatan.id_jabatan',
            'ujikom_nama_jabatan.nama_jabatan',
            'ujikom_penjenjangan.nama_jenjang'];
        $this->db->select($kolom);
        $this->db->from('ujikom_nama_jabatan');  
        $this->db->join('ujikom_jenis_ujikom', 'ujikom_nama_jabatan.id_jenis_ujikom = ujikom_jenis_ujikom.id_jenis_ujikom');
        $this->db->join('ujikom_penjenjangan', 'ujikom_nama_jabatan.id_jabatan = ujikom_penjenjangan.id_jabatan', 'left');
        $this->db->where('ujikom_jenis_ujikom.id_jenis_ujikom', $jenisujikomp);
        return $this->db->get();
    }
    
    /*--masukkan jabatan sekaligus jenjangnya jika jenis uji kompetensi adalah Penjenjangan--*/
    function simpan_jabatan(){
        //masukkan data jabatan
        $jenisujikomp = $this->input->post('jenisujikomp');
        $namajabatan = $this->input->post('namajabatan');
        $data_jabatan = array(
            'id_jenis_ujikom' => $jenisujikomp,
            'nama_jabatan' => $namajabatan
                );       
        $go = $this->db->insert('ujikom_nama_jabatan', $data_jabatan);

        if($go){
           //masukkan jenjang jabatan untuk jabatan yang baru saja dimasukkan
            // jika jenis uji kompetensi adalah Kenaikan Jenjang
            if($jenisujikomp == '2'){
                $insertId = $this->db->insert_id();
                $jmljenjang = $this->input->post('jmljenjang');

                //$result = array();
                for($counter=1; $counter<=$jmljenjang; $counter++){
                    $namajenjang = $this->input->post('namajenjang'.$counter);
                    $data_jenjang[] = array(
                        'id_jabatan' => $insertId,
                        'nama_jenjang'  => $namajenjang
                    );
                }
                return $this->db->insert_batch('ujikom_penjenjangan', $data_jenjang);
            }
            else{
                return true;
            }      
        }
        else{
            return $this->db->error();
        }
    }
}