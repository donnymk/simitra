<div class="container-fluid isi">
<!-- Kolom untuk memilih kab / kota -->
<div class="col-lg-2" align="center">
<table>
<tr>
        <td>Kabupaten / Kota</td>
    </tr>
    <?php
        $kabkota=$this->Model_admin->tampil_kabkota()->result_array();
        foreach($kabkota as $baris){
        	$id_kabkota = $baris['id'];
            $namakota = $baris['nama'];
//            $user = $baris['user'];
//            $password = $baris['password'];
    ?>
    <tr>
        <td>
        <b><a href="?id_kabkota=<?= $id_kabkota ?>&namakota=<?= $namakota ?>"><?= $namakota ?></a></b>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
</div>

<!-- Kolom untuk menampilkan pengajuan dari kab / kota -->
<div class="col-lg-10" align="center">
<?php
//jika link Kabupaten / Kota diklik
if (isset($_GET['id_kabkota'])){
    $id_kabkota=$_GET['id_kabkota'];
    $namakota=$_GET['namakota'];
    //mulai session yaitu menyimpan variabel sementara di server
    $_SESSION['id_kabkota']=$id_kabkota;
    $_SESSION['namakota']=$namakota;
?>
<div class="table-responsive">
<table>
    <tr>
        <td colspan="11"><h4>Pengajuan dari <?= $_SESSION['namakota'] ?></h4></td>
    </tr>
    <tr>
        <th>No.</th>
        <th>Jenis Pelatihan</th>
        <th>Nama Pelatihan & Angkatan</th>
        <th>Pelaksanaan</th>
        <th>Jumlah peserta</th>
        <th>Tempat</th>
        <th colspan="2">Dokumen pengajuan</th>
        <th>Foto</th>
        <th>Daftar Peserta</th>
    </tr>
    <?php
        $no=1;
        $pengajuan=$this->Model_admin->tampil_pengajuan()->result_array();

        //untuk memeriksa jumlah baris
        $jmlbaris = $this->Model_admin->tampil_pengajuan()->num_rows();

        //jika data ditemukan
        foreach($pengajuan as $row){
        	$id_pengajuan = $row['id_pengajuan'];
            $jenisdiklat = $row['jenisdiklat'];
            $namadiklat = $row['namadiklat'];
            $angkatan = $row['angkatan'];
            $pelaksanaan = $row['pelaksanaan'];
            $selesai = $row['selesai'];
            $jmlpeserta = $row['jmlpeserta'];
            $jp = $row['jp'];
            $tempat = $row['tempat'];
            $proposal = $row['proposal'];
            $dok_lain = $row['dok_lain'];
            $status1 = $row['status1'];
            //$status2 = $row['status2'];
            $tanggal_upload = $row['tanggal_upload'];
            //kondisi button default
            $labelcolor="label-warning";
            $btn_proposal='<a href="'.site_url().$proposal.'" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Proposal</a>';
            $btn_dok_lain='<a href="'.site_url().$dok_lain.'" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Dokumen lain</a>';
            $btnjawab='<a href="#" class="edit-record" data-id="'.$id_pengajuan.'" data-toggle="modal" data-target="#modal-jawab"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Jawab</a>';
            $btndownload="";
            //jika dokumen lain tidak diupload
            if ($dok_lain==""){
                $btn_dok_lain="";
            }
            //jika status proposal = dijawab
            if($status1=="dijawab"){
                $labelcolor="label-success";
                $btnjawab='';
                $btndownload="
                <form action='". site_url()."index.php/admin/download_excel' method='post' target='_blank'>
                <div class='btn-group'>
                    <input type='hidden' name='id_pengajuan' value='".$id_pengajuan."'>
                    <button type='submit' class='btn btn-default btn-sm' name='download_excel'>
                    <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span>
                    Unduh data peserta</button>
                    <button data-toggle='dropdown' class='btn btn-default btn-sm dropdown-toggle'>
                    <span class='caret'></span></button>
                    <ul class='dropdown-menu'>
                        <li><a href='admin/unggah_sttpp?page=unggah_sttpp&id_pengajuan=".$id_pengajuan."&jenisdiklat=".$jenisdiklat."&namadiklat=".$namadiklat."&angkatan=".$angkatan."'>
                        <span class='glyphicon glyphicon-cloud-upload' aria-hidden='true'></span> Unggah STTPP</a>
                        </li>
                    </ul>
                </div>
                </form>";
            }
    ?>
    <tr>
        <td><?= $no ?></td>
        <td><?= $jenisdiklat ?></td>
        <td>
            <?= $namadiklat." Angkatan ".$angkatan ?><br>
            <sub>Diajukan pada <?= $tanggal_upload ?></sub>
        </td>
        <td><?= $pelaksanaan." - ".$selesai ?><br>(<?= $jp ?> JP)</td>
        <td><?= $jmlpeserta ?></td>
        <td><?= $tempat ?></td>
        <td><?= $btn_proposal."<br>".$btn_dok_lain ?></td>
        <td><?= $btnjawab  ?>
            <small><span class="label <?= $labelcolor ?>"><?= $status1 ?> </span></small>
        </td>
        <td>
            <a href="javascript:;" class="lihat-foto" data-id="<?= $id_pengajuan ?>" data-toggle="modal" data-target="#modal-lihat-foto">
                <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
            </a>
        </td>
        <td><?= $btndownload ?></td>
        <td>
            <a href="javascript:;" data-id="<?= $id_pengajuan ?>" data-toggle="modal" data-target="#modal-hapus-pengajuan">
                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>
        </td>
    </tr>
    <?php
    $no++;
    }

    //jika data tidak ada dalam database
    if ($jmlbaris==0){
    ?>
        <tr>
		    <td colspan="10"><center>Belum ada pengajuan</center></td>
	    </tr>
    <?php
    }
    ?>
</table><br></div>
<?php
}

//Jika link Kabupaten / Kota tidak diklik
else {
    //ini adalah keadaan awal, belum ada link dan button yang diklik
    if(!isset($_POST['jawab'])){
        echo "<center><b>Silakan pilih Kabupaten / Kota</b></center>";
    }
    //skenario terakhir, jika button 'Jawab' dalam Modal dialog diklik
    else {
        //skrip untuk upload surat rekomendasi (jawab proposal)
        $this->Model_admin->jawab_proposal();
    ?>
<div class="table-responsive">
<table>
    <tr>
        <td colspan="11"><h4>Pengajuan dari <?= $_SESSION['namakota'] ?></h4></td>
    </tr>
    <tr>
        <th>No.</th>
        <th>Jenis Pelatihan</th>
        <th>Nama Pelatihan & Angkatan</th>
        <th>Pelaksanaan</th>
        <th>Jumlah peserta</th>
        <th>Tempat</th>
        <th colspan="2">Dokumen pengajuan</th>
        <th>Foto</th>
        <th>Daftar Peserta</th>
    </tr>
    <?php
        $no=1;
        $pengajuan=$this->Model_admin->tampil_pengajuan()->result_array();

        //untuk memeriksa jumlah baris
        $jmlbaris = $this->Model_admin->tampil_pengajuan()->num_rows();

        //jika data ditemukan
        foreach($pengajuan as $row){
        	$id_pengajuan = $row['id_pengajuan'];
            $jenisdiklat = $row['jenisdiklat'];
            $namadiklat = $row['namadiklat'];
            $angkatan = $row['angkatan'];
            $pelaksanaan = $row['pelaksanaan'];
            $selesai = $row['selesai'];
            $jmlpeserta = $row['jmlpeserta'];
            $tempat = $row['tempat'];
            $jp = $row['jp'];
            $proposal = $row['proposal'];
            $dok_lain = $row['dok_lain'];
            $status1 = $row['status1'];
            //$status2 = $row['status2'];
            $tanggal_upload = $row['tanggal_upload'];
            //kondisi button default
            $labelcolor="label-warning";
            $btn_proposal='<a href="'.site_url().$proposal.'" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Proposal</a>';
            $btn_dok_lain='<a href="'.site_url().$dok_lain.'" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Dokumen lain</a>';
            $btnjawab='<a href="#" class="edit-record" data-id="'.$id_pengajuan.'" data-toggle="modal" data-target="#modal-jawab"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Jawab</a>';
            $btndownload="";
            //jika dokumen lain tidak diupload
            if ($dok_lain==""){
                $btn_dok_lain="";
            }
            //jika status proposal = dijawab
            if($status1=="dijawab"){
                $labelcolor="label-success";
                $btnjawab='';
                $btndownload="
                <form action='". site_url()."index.php/admin/download_excel' method='post' target='_blank'>
                <div class='btn-group'>
                    <input type='hidden' name='id_pengajuan' value='".$id_pengajuan."'>
                    <button type='submit' class='btn btn-default btn-sm' name='download_excel'>
                    <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span>
                    Unduh data peserta</button>
                    <button data-toggle='dropdown' class='btn btn-default btn-sm dropdown-toggle'>
                    <span class='caret'></span></button>
                    <ul class='dropdown-menu'>
                        <li><a href='admin/unggah_sttpp?page=unggah_sttpp&id_pengajuan=".$id_pengajuan."&jenisdiklat=".$jenisdiklat."&namadiklat=".$namadiklat."&angkatan=".$angkatan."'>
                        <span class='glyphicon glyphicon-cloud-upload' aria-hidden='true'></span> Unggah STTPP</a>
                        </li>
                    </ul>
                </div>
                </form>";
            }
    ?>
    <tr>
        <td><?= $no ?></td>
        <td><?= $jenisdiklat ?></td>
        <td>
            <?= $namadiklat." Angkatan ".$angkatan ?><br>
            <sub>Diajukan pada <?= $tanggal_upload ?></sub>
        </td>
        <td><?= $pelaksanaan." - ".$selesai ?><br>(<?= $jp ?> JP)</td>
        <td><?= $jmlpeserta ?></td>
        <td><?= $tempat ?></td>
        <td><?= $btn_proposal."<br>".$btn_dok_lain ?></td>
        <td><?= $btnjawab  ?>
            <small><span class="label <?= $labelcolor ?>"><?= $status1 ?> </span></small>
        </td>
        <td>
            <a href="javascript:;" class="lihat-foto" data-id="<?= $id_pengajuan ?>" data-toggle="modal" data-target="#modal-lihat-foto">
                <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
            </a>
        </td>
        <td><?= $btndownload ?></td>
        <td>
            <a href="javascript:;" data-id="<?= $id_pengajuan ?>" data-toggle="modal" data-target="#modal-hapus-pengajuan">
                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>
        </td>
    </tr>
    <?php
    $no++;
    }

    //jika data tidak ada dalam database
    if ($jmlbaris==0){
    ?>
        <tr>
		    <td colspan="10"><center>Belum ada pengajuan</center></td>
	    </tr>
    <?php
    }
    ?>
</table><br></div>
    <?php
    }
}
?>

</div>
</div>

<!-- modal jawab-->
<div id="modal-jawab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Jawab Proposal</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

    <!-- modal lihat foto-->
<div id="modal-lihat-foto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 claass="modal-title">Foto</h4>
			</div>
		    <div class="modal-body">
		    </div>
		</div>
	</div>
</div>

<!-- modal hapus pengajuan-->
<div id="modal-hapus-pengajuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 claass="modal-title">Hapus Pengajuan</h4>
			</div>
		    <div class="modal-body btn-danger">
                Pengajuan beserta dokumennya akan dihapus. Lanjutkan?
		    </div>
		    <div class="modal-footer">
			    <a href="javascript:;" class="btn btn-default" id="hapus-true">Ya</a>
			    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
		    </div>
		</div>
	</div>
</div>

<!-- Menampilkan data pada Modal jawab yang diambil dari file modal_jawab.php-->
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#modal-jawab").modal('show');
                $.post('<?= site_url() ?>index.php/admin/modal_jawab',
                    {id_pengajuan:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
    </script>
    
<!-- Menampilkan data pada Modal lihat foto yang diambil dari file modal_lihat_foto.php-->
    <script>
        $(function(){
            $(document).on('click','.lihat-foto',function(e){
                e.preventDefault();
                $("#modal-lihat-foto").modal('show');
                $.post('<?= site_url() ?>index.php/admin/modal_lihat_foto',
                    {id_pengajuan:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
    </script>
<!-- Untuk menghapus pengajuan melalui file hapuspengajuan.php-->
<script>
	$(document).ready(function(){
		$('#modal-hapus-pengajuan').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

            // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id')
			var modal = $(this)
			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","<?= site_url() ?>index.php/admin/hapus_pengajuan?id="+id);
		})
	});
</script>