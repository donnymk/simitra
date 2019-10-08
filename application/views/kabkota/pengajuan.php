<div class="container-fluid isi">
<div class="row">
<div class="content">
    <!--Kolom untuk pemberitahuan ketika pesan berhasil atau gagal upload proposal-->
    <div id="msg" class="col-md-12">
    <?php
    foreach($user as $hasil){
    $id_user = $hasil->id;
    }
    //script untuk upload proposal jika submit button diklik
    $this->Model_kabkota->upload_proposal();
    ?>
    </div>

    <!-- Kolom untuk form input proposal -->
<div class="col-lg-3">
    <h4>Formulir Pengajuan Pelatihan</h4>
    <form id="uploadForm" method="post" enctype="multipart/form-data" role="form">
        <table class="table">
<tr>
    <td>
    <div class="form-group">
        <strong>Jenis Pelatihan *</strong><br/>
        <input type="hidden" name="iduser" value="<?= $id_user ?>">
        <select type="text" id="jenisdiklat" class="form-control" name="jenisdiklat" required>
            <option value=''>--Pilih--</option>
            <option value='Diklat Teknis' name="add">Pelatihan Teknis</option>
          <option value="Diklat Fungsional">Pelatihan Fungsional</option>
          <option value='Diklat Kepemimpinan'>Pelatihan Kepemimpinan</option>
          <option value='Diklat Prajabatan'>Pelatihan Prajabatan</option>
        </select>
    </div>
    <div class="form-group">
        <strong>Nama Pelatihan *</strong><br/>
        <input type=text id="namadiklat" class="form-control" name="namadiklat" placeholder="Nama Pelatihan" required>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <strong>Angkatan *</strong><br/>
                <input type="number" id="angkatan" class="form-control" name="angkatan" placeholder="mis: 2" min="1" max="99" required>
            </div>
            <div class="col-md-5">
                <strong>Jumlah peserta *</strong><br/>
                <input type="number" id="jmlpeserta" class="form-control" name="jmlpeserta" placeholder="mis: 30" min="1" max="99" required>
            </div>
            <div class="col-md-4">
                <strong>JP *</strong><br/>
                <input type="number" id="jp" class="form-control" name="jp" placeholder="mis: 12" min="1" max="24" required>
            </div>
        </div>
    </div>
    <div class="form-group form-inline">
        <strong>Tanggal pelaksanaan *</strong><br/>
    <select type="text" id="tgl" class="form-control input-sm" name="tgl">
        <?php
        for($tgl=1;$tgl<=31;$tgl++){
        ?>
        <option value='<?= $tgl ?>' <?php if($tgl==17){echo "selected";} ?>><?= $tgl ?></option>
        <?php
        }
        ?>
    </select>
    <select type="text" id="bulan" class="form-control input-sm" name="bulan">
      <option value='01' name="add">Januari</option><option value="02">Pebruari</option><option value="03">Maret</option>
      <option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option>
      <option value="07">Juli</option><option value="08" selected>Agustus</option><option value="09">September</option>
      <option value="10">Oktober</option><option value="11">Nopember</option><option value="12">Desember</option>
    </select>
    <select type="text" id="tahun" class="form-control input-sm" name="tahun">
        <?php
        $tahun=$this->Model_kabkota->tampil_tahun()->result();
        foreach($tahun as $baris){
        	$thn = $baris -> tahun;
        }
        for($date=$thn;$date<=$thn+2;$date++){
        ?>
        <option value='<?= $date ?>'><?= $date ?></option>
        <?php
        }
        ?>
    </select>
        <strong><br>sampai *</strong><br/>
    <select type="text" id="tglselesai" class="form-control input-sm" name="tglselesai">
        <?php
        for($tgl=1;$tgl<=31;$tgl++){
        ?>
        <option value='<?= $tgl ?>' <?php if($tgl==17){echo "selected";} ?>><?= $tgl ?></option>
        <?php
        }
        ?>
    </select>
    <select type="text" id="bulanselesai" class="form-control input-sm" name="bulanselesai">
      <option value='01' name="add">Januari</option><option value="02">Pebruari</option><option value="03">Maret</option>
      <option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option>
      <option value="07">Juli</option><option value="08" selected>Agustus</option><option value="09">September</option>
      <option value="10">Oktober</option><option value="11">Nopember</option><option value="12">Desember</option>
    </select>
    <select type="text" id="tahunselesai" class="form-control input-sm" name="tahunselesai">
        <?php
        for($date=$thn;$date<=$thn+2;$date++){
        ?>
        <option value='<?= $date ?>'><?= $date ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="form-group">

    </div>
    <div class="form-group">
        <strong>Tempat penyelenggaraan *</strong><br/>
        <input type="text" id="tempat" class="form-control" name="tempat" required>
    </div>
    <div class="form-group">
        <strong>Dokumen proposal *</strong><br/>
    <input type="file" id="peroposal" name="peroposal" accept=".doc, .docx, .dot, .dotx, .docm, .dotm" required>
    </div>
    <div class="form-group">
        <strong>Dokumen lain</strong><br/>
    <input type="file" id="dokumen" name="dokumen" accept=".doc, .docx, .dot, .dotx, .docm, .dotm">
    </div>
    <div class="form-group">
        <strong>Ketersediaan Fasilitas / Ruangan</strong><br/>
<!--    <input type="file" name="foto1" accept="image/*">
    <input type="file" name="foto2" accept="image/*">
    <input type="file" name="foto3" accept="image/*">
    <input type="file" name="foto4" accept="image/*">
    <input type="file" name="foto5" accept="image/*">-->
        <table>
            <tr>
                <td><label>Ruang Kelas</label></td>
                <td>: </td>
                <td>
                    Ya <input type="radio" name="foto1" id="foto1_1" value="Ya" required="">
                    Tidak <input type="radio" name="foto1" id="foto1_2" value="Tidak">                     
                </td>
            </tr>
            <tr>
                <td><label>Ruang Asrama</label></td>
                <td>: </td>
                <td>
                    Ya <input type="radio" name="foto2" id="foto2_1" value="Ya" required="">
                    Tidak <input type="radio" name="foto2" id="foto2_2" value="Tidak">                    
                </td>
            </tr>
            <tr>
                <td><label>Ruang Makan</label></td>
                <td>: </td>
                <td>
                    Ya <input type="radio" name="foto3" id="foto3_1" value="Ya" required="">
                    Tidak <input type="radio" name="foto3" id="foto3_2" value="Tidak">                    
                </td>
            </tr>
            <tr>
                <td><label>Lapangan</label></td>
                <td>: </td>
                <td>
                    Ya <input type="radio" name="foto4" id="foto4_1" value="Ya" required="">
                    Tidak <input type="radio" name="foto4" id="foto4_2" value="Tidak">                    
                </td>
            </tr>
            <tr>
                <td><label>Kamar Mandi dan Toilet</label></td>
                <td>: </td>
                <td>
                    Ya <input type="radio" name="foto5" id="foto5_1" value="Ya" required="">
                    Tidak <input type="radio" name="foto5" id="foto5_2" value="Tidak">                     
                </td>
            </tr>
        </table>
    </div>
    </td>
</tr>
</table>
        <center>
            <button type="submit" class="btn btn-danger btn-lg" name="submit" onclick="check_ajuan_diklat()">
                <span class='glyphicon glyphicon-send' aria-hidden='true'></span> Submit
            </button>
        </center>
    </form>
<br>
</div>

<!-- Kolom untuk menampilkan proposal yang sudah diinput -->
<div class="col-lg-9" align="center">
    <h4>Status Pengajuan</h4>
<div class="table-responsive">
    <table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Jenis pelatihan</th>
        <th>Nama pelatihan & angkatan</th>
        <th>Pelaksanaan</th>
        <th>Jumlah peserta</th>
        <th>Tempat</th>
        <th>Status</th>
    </tr>
    <?php
    $no=1;
    //untuk memeriksa jumlah baris
    $jmlbaris = $this->Model_kabkota->tampil_proposal($id_user)->num_rows();
    //query untuk menampilkan data proposal
    $tampil=$this->Model_kabkota->tampil_proposal($id_user)->result_array();
    //jika data ditemukan
    foreach ($tampil as $row){
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
        $status1 = $row['status1'];
        $status2 = $row['status2'];
        $tanggal_upload = $row['tanggal_upload'];
        //kondisi button default
        $uploadbtn="";
        $labelcolor="label-warning";
        $labelcolor2="label-warning";
        $download1="";
        $btnlihat="";

        //jika status proposal = dijawab
        if($status1=="dijawab"){
            //warna label menjadi hijau
            $labelcolor="label-success";
            //ada upload button
            $uploadbtn="<button name='unggah' type='submit' class='btn btn-success btn-sm'>
            <span class='glyphicon glyphicon-cloud-upload' aria-hidden='true'></span> Unggah peserta</button>";
            //ada popup modal untuk melihat jawaban dan surat rekomendasi
            $btnlihat="<a href='javascript:;' class='edit-record' data-id='".$id_pengajuan."' data-toggle='modal' data-target='#modal-balasan'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span> Lihat jawaban</a>";
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
            <td><span class="label <?= $labelcolor ?>"><?= $status1 ?></span>
            <!--<span class="label <?php echo $labelcolor2 ?>"><?php echo  $status2 ?> </span>-->
            <br/><?= $btnlihat ?>
            </td>
            <td>
            <form action="<?= site_url('index.php/kabkota/menu_unggah_peserta') ?>" method="POST">
                <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan ?>">
                <input type="hidden" name="jenisdiklat" value="<?= $jenisdiklat ?>">
                <input type="hidden" name="namadiklat" value="<?= $namadiklat ?>">
                <input type="hidden" name="angkatan" value="<?= $angkatan ?>">
                <?= $uploadbtn ?>
            </form>
            </td>
        </tr>
        <?php
        $no++;
    }

    //jika data tidak ada dalam database
    if ($jmlbaris==0){
    ?>
        <tr>
		    <td colspan="8"><center>Belum ada pengajuan</center></td>
	    </tr>
    <?php
    }
    ?>
</table>
</div>
</div>
</div>
</div>
</div>

<!-- Modal balasan-->
<div id="modal-balasan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Balasan</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- Menampilkan data pada modal balasan yang diambil dari file modal_balasan.php-->
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#modal-balasan").modal('show');
                $.post('<?= site_url("index.php/kabkota/modal_balasan") ?>',
                    {id_pengajuan:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
    </script>