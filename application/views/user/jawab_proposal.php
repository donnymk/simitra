<?php
if(isset($_POST['jawab'])){
    //Buat konfigurasi upload
    //Folder tujuan upload file
    $eror		= false;
    $folder		= '../surat/';
    //type file yang bisa diupload
    $file_type	= array('doc','docx');
    //tukuran maximum file yang dapat diupload
    $max_size	= 3000000; // 3MB

	//Mulai memorises data
    $id_pengajuan=$_POST['id_pengajuan'];
    $ket=$_POST['ket'];
	$file_name1	= $_FILES['surat_rekomendasi']['name'];
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
    //periksa apakah nama file yang akan diupload mirip dengan nama yang ada di database
    $query_cek_rekomendasi="select surat from rekomendasi where surat='$folder$file_name1'";
    $cek_rekomendasi=mysqli_query($koneksi,$query_cek_rekomendasi);
    //jika mirip maka upload dibatalkan
    if(mysqli_fetch_row($cek_rekomendasi)){
        $eror   = true;
        $pesan  = '<div class="alert alert-danger alert dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Terjadi kesalahan, mohon ganti nama file rekomendasi dengan nama yang lain
        </div>';
    }

	if($eror == true){
		echo '<div id="eror">'.$pesan.'</div>';
	}
	else{
		//mulai memproses upload file
		if(move_uploaded_file($_FILES['surat_rekomendasi']['tmp_name'], $folder.$file_name1)){
			//catat nama file ke database
            $query_update1="UPDATE rekomendasi SET surat='$folder$file_name1', ket='$ket', tgl_terbit=now() WHERE id_pengajuan='$id_pengajuan'";
            $query_update2="UPDATE pengajuan set status1='dijawab' WHERE id_pengajuan='$id_pengajuan'";

            mysqli_query($koneksi,$query_update1);
            mysqli_query($koneksi,$query_update2);
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
?>