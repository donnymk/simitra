<?php
class Model_kabkota extends CI_Model{

    function cek_kabkota($username,$password){
        // ambil data user dan password dari tabel kabkota
        return $this->db->get_where('kabkota',array('user'=>$username,'password'=>$password));
    }
    
    //cek apakah user kontributor ada di database
    function cek_user($username){
        //$sijarion_db = $this->load->database('sijarion', TRUE);
        return $this->db->get_where('user',array('kode'=>$username));
    }

    function login_kabkota(){
        return $this->db->get_where('user',array('kode'=>$_SESSION['kodeuser']));
    }

    function upload_proposal(){
        if(isset($_POST['submit'])){
            //Buat konfigurasi upload
            //Folder tujuan upload file
            $eror		= false;
            $folder		= 'dokumen/';
            $folderfoto	= 'foto/';
            $tanggal=date("d-m-Y_h.i.s");
            //type file yang bisa diupload
            $file_type	= array('doc','docx','dot','dotx','docm','dotm','jpg','jpeg','bmp','png');
            //tukuran maximum file yang dapat diupload
            $max_size	= 3000000; // 3MB

            //Mulai memorises data
            $idkabkota = $_POST['iduser'];
        	$jenisdiklat=$_POST['jenisdiklat'];
        	$namadiklat=$_POST['namadiklat'];
            $angkatan=$_POST['angkatan'];
            $tgl=$_POST['tgl'];
            $bulan=$_POST['bulan'];
            $tahun=$_POST['tahun'];
            $tglselesai=$_POST['tglselesai'];
            $bulanselesai=$_POST['bulanselesai'];
            $tahunselesai=$_POST['tahunselesai'];
            $jmlpeserta=$_POST['jmlpeserta'];
            $jp=$_POST['jp'];
            $tempat=$_POST['tempat'];
            $file_name1	= $folder.$tanggal.'_'.$_FILES['peroposal']['name'];
            $file_size1	= $_FILES['peroposal']['size'];
            $file_name2	= $folder.$tanggal.'_'.$_FILES['dokumen']['name'];
            $file_size2	= $_FILES['dokumen']['size'];
//            $photo1	= $_FILES['foto1']['name'];
//            $photo2	= $_FILES['foto2']['name'];
//            $photo3	= $_FILES['foto3']['name'];
//            $photo4	= $_FILES['foto4']['name'];
//            $photo5	= $_FILES['foto5']['name'];
//            $photo_name1=$folderfoto.$tanggal."_".$photo1;
//            $photo_name2=$folderfoto.$tanggal."_".$photo2;
//            $photo_name3=$folderfoto.$tanggal."_".$photo3;
//            $photo_name4=$folderfoto.$tanggal."_".$photo4;
//            $photo_name5=$folderfoto.$tanggal."_".$photo5;
            $foto1 = $_POST['foto1'];
            $foto2 = $_POST['foto2'];
            $foto3 = $_POST['foto3'];
            $foto4 = $_POST['foto4'];
            $foto5 = $_POST['foto5'];
            if($_FILES['dokumen']['name']==''){
                $file_name2='';
            }
//            if($_FILES['foto1']['name']==''){
//                $photo_name1='';
//            }
//            if($_FILES['foto2']['name']==''){
//                $photo_name2='';
//            }
//            if($_FILES['foto3']['name']==''){
//                $photo_name3='';
//            }
//            if($_FILES['foto4']['name']==''){
//                $photo_name4='';
//            }
//            if($_FILES['foto5']['name']==''){
//                $photo_name5='';
//            }
            //cari extensi file dengan menggunakan fungsi explode
            $explode	= explode('.',$file_name1);
            $extensi	= $explode[count($explode)-1];

            //check apakah type file sudah sesuai
            if(!in_array($extensi,$file_type)){
                $eror   = true;
                $pesan  = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Tipe file yang anda unggah tidak sesuai</div>';
            }
            //check ukuran file apakah sudah sesuai
            if($file_size1 > $max_size){
                $eror   = true;
                $pesan  = '<div class="alert alert-danger" role="alert">Ukuran file melebihi batas maksimum</div>';
            }
            //jika error tentang tipe dan ukuran file terjadi (bernilai benar)
            if($eror == true){
                echo $pesan;
            }
            else{
                //mulai memproses upload file
                if(move_uploaded_file($_FILES['peroposal']['tmp_name'], $file_name1)){
                    move_uploaded_file($_FILES['dokumen']['tmp_name'], $file_name2);
//                    move_uploaded_file($_FILES['foto1']['tmp_name'], $photo_name1);
//                    move_uploaded_file($_FILES['foto2']['tmp_name'], $photo_name2);
//                    move_uploaded_file($_FILES['foto3']['tmp_name'], $photo_name3);
//                    move_uploaded_file($_FILES['foto4']['tmp_name'], $photo_name4);
//                    move_uploaded_file($_FILES['foto5']['tmp_name'], $photo_name5);
                    //catat nama file ke database
                    $query_masuk="INSERT INTO pengajuan (id_kabkota, jenisdiklat, namadiklat, angkatan, tanggal, tanggal_selesai, jmlpeserta, jp, tempat, proposal, dok_lain, status1, status2, tgl_upload) VALUES ('$idkabkota', '$jenisdiklat', '$namadiklat', '$angkatan', '$tahun-$bulan-$tgl', '$tahunselesai-$bulanselesai-$tglselesai', '$jmlpeserta', '$jp', '$tempat', '$file_name1', '$file_name2', 'belum dijawab', 'dalam proses', now())";
                    //$query_masuk1="INSERT INTO pengajuan_detail (foto1, foto2, foto3, foto4, foto5) VALUES ('$photo_name1', '$photo_name2', '$photo_name3', '$photo_name4', '$photo_name5')";
                    $query_masuk1="INSERT INTO pengajuan_detail (foto1, foto2, foto3, foto4, foto5) VALUES ('$foto1', '$foto2', '$foto3', '$foto4', '$foto5')";
                    $query_masuk2="INSERT INTO rekomendasi (surat, ket, tgl_terbit) VALUES (NULL, NULL, NULL)";

                    $this->db->query($query_masuk);
                    $this->db->query($query_masuk1);
                    $this->db->query($query_masuk2);
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Terima kasih. Pengajuan Pelatihan berhasil</strong> dan akan kami proses. Silakan lihat di panel "Status Pengajuan" untuk memantau pengajuan pelatihan Anda.
                    </div>';
                }
                else{
                    echo '<div class="alert alert-warning" role="alert">Upload Gagal, Coba Lagi</div>';
                }
            }
        }
    }

    function tampil_tahun(){
        return $this->db->query('select year(now()) as tahun');
    }

    function tampil_proposal($id_kabkota){
        return $this->db->query("SELECT *, DATE_FORMAT(tanggal, '%d/%m/%Y') AS pelaksanaan, DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') AS selesai, DATE_FORMAT(tgl_upload, '%d/%m/%Y %T') AS tanggal_upload FROM pengajuan WHERE pengajuan.id_kabkota='$id_kabkota'");
    }

    function tampil_balasan(){
        return $this->db->query("SELECT *, DATE_FORMAT(tgl_terbit, '%d/%m/%Y %T') AS tanggal_terbit FROM rekomendasi WHERE id_pengajuan='".$_POST['id_pengajuan']."'");
    }

    function cek_excel_upload($id_pengajuan){
        //proses eksekusi query apakah file excel sudah diupload
        return $this->db->query("SELECT * FROM dok_peserta WHERE id_pengajuan='$id_pengajuan'");
    }

    function excel_upload(){
        if(isset($_POST['upload'])){
            //Buat konfigurasi upload
            //Folder tujuan upload file
            $eror		= false;
            $folder		= 'dokumen/';
            $tanggal=date("d-m-Y_h.i.s");
            //type file yang bisa diupload
            $file_type	= array('xls','xlsx');
            //tukuran maximum file yang dapat diupload
            $max_size	= 3000000; // 3MB

        	//Mulai memorises data
            $idpengajuan=$_POST['idpengajuan'];
        	$file_name1	= $folder.$tanggal.'_'.$_FILES['upload_xls']['name'];
        	$file_size1	= $_FILES['upload_xls']['size'];
        	//cari extensi file dengan menggunakan fungsi explode
        	$explode	= explode('.',$file_name1);
        	$extensi	= $explode[count($explode)-1];

        	//check apakah type file sudah sesuai
        	if(!in_array($extensi,$file_type)){
        		$eror   = true;
        		$pesan  = 'Tipe file yang anda unggah tidak sesuai. Pastikan tipe file adalah .xls atau .xlsx';
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
        		if(move_uploaded_file($_FILES['upload_xls']['tmp_name'], $file_name1)){
        			//catat nama file ke database
                    $query_masuk="INSERT INTO dok_peserta (id_pengajuan,dok,tgl_upload) VALUES ('$idpengajuan','$file_name1',now())";
                    $this->db->query($query_masuk);
        		}
                else{
        			echo '<div class="alert alert-warning" role="alert">Upload Gagal, Coba Lagi</div>';
        		}
        	}
        }
    }

    function tampil_sttpp($id_kabkota){
        return $this->db->query("SELECT pengajuan.jenisdiklat, pengajuan.namadiklat, pengajuan.angkatan, dok_sttpp.id_dok_sttpp, dok_sttpp.dok_sttpp, DATE_FORMAT(dok_sttpp.tgl_terbit, '%d/%m/%Y %T') AS tgl_terbit FROM pengajuan INNER JOIN dok_sttpp ON pengajuan.id_pengajuan=dok_sttpp.id_pengajuan WHERE pengajuan.id_kabkota='".$id_kabkota."'");
    }
    
    function load_jenisujikomp(){
        return $this->db->get('ujikom_jenis_ujikom');
    }
    
    function load_jabatan($jenisujikomp){
        // ambil data
        $kolom = ['ujikom_nama_jabatan.id_jabatan','ujikom_nama_jabatan.nama_jabatan'];
        $this->db->select($kolom);
        $this->db->from('ujikom_nama_jabatan');  
        $this->db->join('ujikom_jenis_ujikom', 'ujikom_nama_jabatan.id_jenis_ujikom = ujikom_jenis_ujikom.id_jenis_ujikom');
        $this->db->where('ujikom_jenis_ujikom.id_jenis_ujikom', $jenisujikomp);
        return $this->db->get();
    }
    
    function load_jenjang($idjabatan){
        // ambil data
        $kolom = ['ujikom_penjenjangan.id_penjenjangan','ujikom_penjenjangan.nama_jenjang'];
        $this->db->select($kolom);
        $this->db->from('ujikom_penjenjangan');  
        $this->db->join('ujikom_nama_jabatan', 'ujikom_penjenjangan.id_jabatan = ujikom_nama_jabatan.id_jabatan');
        $this->db->where('ujikom_nama_jabatan.id_jabatan', $idjabatan);
        return $this->db->get();
    }
    
    function lihat_usulanujikomp(){
        // ambil data
        $kolom = ['ujikom_usulan_ujikom.id_usulan_ujikom',
            'ujikom_jenis_ujikom.jenis_ujikom',
            'ujikom_nama_jabatan.nama_jabatan',
            'ujikom_penjenjangan.nama_jenjang',
            'ujikom_usulan_ujikom.jumlah_peserta',
            'ujikom_usulan_ujikom.tgl_usul'];
        $this->db->select($kolom);
        $this->db->from('ujikom_usulan_ujikom');  
        $this->db->join('ujikom_jenis_ujikom', 'ujikom_usulan_ujikom.id_jenis_ujikom = ujikom_jenis_ujikom.id_jenis_ujikom');
        $this->db->join('ujikom_nama_jabatan', 'ujikom_usulan_ujikom.id_jabatan = ujikom_nama_jabatan.id_jabatan', 'left');
        $this->db->join('ujikom_penjenjangan', 'ujikom_usulan_ujikom.id_penjenjangan = ujikom_penjenjangan.id_penjenjangan', 'left');
        $this->db->where('ujikom_usulan_ujikom.id_user', $_SESSION['iduser']);
        return $this->db->get();
    }
    
    function del_usulan_ujikomp($idusulanujikomp){
        // delete data
        $this->db->where('id_usulan_ujikom',$idusulanujikomp);
        $delete_ujikom = $this->db->delete('ujikom_usulan_ujikom');
        
        $this->db->where('id_usulan_ujikom',$idusulanujikomp);
        $delete_peserta = $this->db->delete('ujikom_peserta_ujikom');
        
        if($delete_ujikom && $delete_peserta){
            return true;
        }
        else{
            return $this->db->error();
        }
    }
    
    function load_peserta_ujikomp($idusulanujikomp){
        // ambil data
        $kolom = ['ujikom_peserta_ujikom.nip',
            'ujikom_peserta_ujikom.nama',
            'ujikom_peserta_ujikom.jabatan',
            'ujikom_peserta_ujikom.opd'];
        $this->db->select($kolom);
        $this->db->from('ujikom_peserta_ujikom');  
        $this->db->where('ujikom_peserta_ujikom.id_usulan_ujikom', $idusulanujikomp);
        return $this->db->get();
    }
    
    /*--masukkan jabatan sekaligus uraian jabatannya--*/
    function simpan_usulanujikomp(){
        //masukkan data usulan uji kompetensi
        $idkabkota = $this->input->post('idkabkota');
        $jenisujikomp = $this->input->post('jenisujikomp');
        $idjabatan = $this->input->post('idjabatan');
        $idjenjangjabatan = $this->input->post('idjenjangjabatan');
        $jmlasn = $this->input->post('jmlasn');
        $data_usulanujikomp = ['id_user' => $idkabkota,
            'id_jenis_ujikom' => $jenisujikomp,
            'id_jabatan' => $idjabatan,
            'id_penjenjangan' => $idjenjangjabatan,
            'jumlah_peserta' => $jmlasn];       
        $go = $this->db->insert('ujikom_usulan_ujikom', $data_usulanujikomp);
        
        //masukkan uraian jabatan untuk jabatan yang baru saja dimasukkan
        $insertId = $this->db->insert_id();
        //$nippns = $this->input->post('nippns');
        //$tipepns = 'KABKOT';
        
        //$result = array();
        for($counter=0; $counter<$jmlasn; $counter++){
            $data_peserta[] = array(
                'id_usulan_ujikom' => $insertId,
                'nip'  => $this->input->post('nippns'.$counter),
                'nama'  => $this->input->post('namapns'.$counter),
                'jabatan'  => $this->input->post('jabatanpns'.$counter),
                'opd'  => $this->input->post('opdpns'.$counter)
            );            
        }        
        if(!$go){
            return $this->db->error();
        }
        else{
           return $this->db->insert_batch('ujikom_peserta_ujikom', $data_peserta);
        }
    }
}