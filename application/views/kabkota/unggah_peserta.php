<div class="container-fluid isi">
    <?php
    //jika halaman ini dikunjungi lewat tombol 'Unggah data peserta' pada halaman pengajuan.php
    if(isset($_POST['unggah'])){
        $id_pengajuan=$_POST['id_pengajuan'];
        $jenisdiklat=$_POST['jenisdiklat'];
        $namadiklat=$_POST['namadiklat'];
        $angkatan=$_POST['angkatan'];

        //menyimpan informasi ke server yang nantinya digunakan untuk query
        $_SESSION['id_pengajuan']=$id_pengajuan;
        $_SESSION['jenisdiklat']=$jenisdiklat;
        $_SESSION['namadiklat']=$namadiklat;
        $_SESSION['angkatan']=$angkatan;

        //proses eksekusi query apakah file excel sudah diupload
        $jalan=$this->Model_kabkota->cek_excel_upload($id_pengajuan)->result_array();

        //untuk memeriksa jumlah baris
        $jmlbaris = $this->Model_kabkota->cek_excel_upload($id_pengajuan)->num_rows();

        //jika jumlah baris=0 (belum diupload) maka akan muncul form untuk upload file excel
        if ($jmlbaris==0){
        ?>
            <h4>Unggah Data Peserta</h4>
            Silakan unggah data peserta <?= $_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan'] ?>
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                    <strong>File Excel *</strong>
                    <input type="hidden" name="idpengajuan" value="<?= $_SESSION['id_pengajuan'] ?>">
                    <input type="file" name="upload_xls" accept=".xls, .xlsx" required>
                    <br>
                    <input type="submit" name="upload" value="Unggah" class="btn btn-danger"> 
                </div>
            </form>
        <?php
        }
        //jika file excel sudah diuplad
        else {
        ?>
            <div class="alert alert-success" role="alert">
            <label>Terima kasih. Anda sudah mengunggah data peserta <?= $_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan'] ?>.</label>
            <!--<a href="javascript:;" class="edit-record" data-id="<?php echo $_SESSION['id_pengajuan'] ?>" data-toggle="modal" data-target="#modal-revisi">Revisi data peserta</a>-->
            </div>
            <div class="table-responsive">
                <table class="table">
            <tr>
                <td colspan="12"><h4>Berikut adalah daftar peserta yang Anda unggah</h4></td>
            </tr>
        <?php
        require_once  'plugins/phpexcel/PHPExcel/IOFactory.php';
        foreach($jalan as $row){
            $dok_peserta=$row['dok'];

            $objPHPExcel = PHPExcel_IOFactory::load($dok_peserta);
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $no = 1;
            foreach($sheet as $row):
                echo '<tr>';
                foreach($row as $key => $val)
                    echo '<td>'. $row[$key] .'</td>';
                echo '</tr>';
                $no++;
            endforeach;
        }
        ?>
        </table>
        </div>
        <?php
        }
    }

    //kalau tidak dikunjungi lewat tombol 'Unggah data peserta'
    else {
        //tambahkan script untuk upload file excel
        $this->Model_kabkota->excel_upload();

        //proses eksekusi query apakah file excel sudah diupload
        $jalan=$this->Model_kabkota->cek_excel_upload($_SESSION['id_pengajuan'])->result_array();

        //untuk memeriksa jumlah baris
        $jmlbaris = $this->Model_kabkota->cek_excel_upload($_SESSION['id_pengajuan'])->num_rows();

        //jika file excel sudah diupload
        if ($jmlbaris==1){
        ?>
        <div class="alert alert-success" role="alert">
        <label>Terima kasih. Anda sudah mengunggah data peserta <?= $_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan'] ?>.</label>
        <!--<a href="javascript:;" class="edit-record" data-id="<?php echo $_SESSION['id_pengajuan'] ?>" data-toggle="modal" data-target="#modal-revisi">Revisi data peserta</a>-->
        </div>
        <div class="table-responsive">
        <table>
        <tr>
            <td colspan="12"><h4>Berikut adalah daftar peserta yang Anda unggah</h4></td>
        </tr>
        <?php
        require_once  'plugins/phpexcel/PHPExcel/IOFactory.php';
        foreach($jalan as $row){
            $dok_peserta=$row['dok'];

            $objPHPExcel = PHPExcel_IOFactory::load($dok_peserta);
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $no = 1;
            foreach($sheet as $row):
                echo '<tr>';
                foreach($row as $key => $val)
                    echo '<td>'. $row[$key] .'</td>';
                echo '</tr>';
                $no++;
            endforeach;
        }
        ?>
        </table>
        </div>
        <?php
        }

        //jika belum diupload maka akan muncul form untuk upload file excel
        else {
        ?>
        <form action="" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
        <table>
        <tr><td colspan="2"><h4>Unggah Data Peserta</h4>
        <small><?= $_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan'] ?></small>
        </td></tr>
        <tr>
        <td>
            <label>File Excel *</label>
            <div class="form-group">
            <input type="hidden" name="idpengajuan" value="<?= $_SESSION['id_pengajuan'] ?>">
            <input type="file" name="upload_xls" accept=".xls, .xlsx" required>
            </div>
        </td>
        <td><input type="submit" name="upload" value="Unggah" class="btn btn-danger"></td>
        </tr>
        </table>
        </form>
    <?php
        }
    }
?>
</div>

<!-- modal revisi-->
<div id="modal-revisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Revisi data peserta</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- Menampilkan data pada Modal revisi yang diambil dari file modal_revisi.php-->
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#modal-revisi").modal('show');
                $.post('pages/modal_revisi.php',
                    {id_pengajuan:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
    </script>