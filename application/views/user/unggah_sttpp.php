<div class="container-fluid content">
<!-- Kolom untuk menampilkan pengajuan dari kab / kota -->
<div class="col-md-8">
<?php
//jika link Kabupaten / Kota diklik
if (isset($_GET['id_pengajuan'])){
    $id_pengajuan=$_GET['id_pengajuan'];
    $jenisdiklat=$_GET['jenisdiklat'];
    $namadiklat=$_GET['namadiklat'];
    $angkatan=$_GET['angkatan'];
    //mulai session yaitu menyimpan variabel sementara di server
    $_SESSION['id_pengajuan']=$id_pengajuan;
    $_SESSION['jenisdiklat']=$jenisdiklat;
    $_SESSION['namadiklat']=$namadiklat;
    $_SESSION['angkatan']=$angkatan;

    //tambahkan script untuk upload sttpp
    $this->Model_user->unggah_sttpp_aksi();

    //periksa apakah sttpp sudah diupload
    $cek_sttpp=$this->Model_user->cek_sttpp($id_pengajuan)->num_rows();

    //jika jumlah baris=0 (belum diupload) maka akan muncul form untuk upload file excel
    if ($cek_sttpp==0){
    ?>
        <form action="" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
        <table>
        <tr><td colspan="2"><h4>Unggah STTPP</h4>
        <small><?php echo "".$_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan']."" ?></small>
        </td></tr>
        <tr>
        <td>
            <label>File Excel *</label>
            <div class="form-group">
            <input type="hidden" name="idpengajuan" value="<?php echo $_SESSION['id_pengajuan'] ?>">
            <input type="file" name="upload_sttpp" required>
            </div>
        </td>
        <td><button type="submit" name="unggah_sttpp" class="btn btn-danger"><span class='glyphicon glyphicon-cloud-upload' aria-hidden='true'></span> Unggah</button></td>
        </tr>
        </table>
        </form>
    <?php
    }
    //jika file excel sudah diuplad
    else {
        $sttpp=$this->Model_user->cek_sttpp($id_pengajuan)->result_array();
        foreach($sttpp as $row){
            $dok_sttpp=$row['dok_sttpp'];
        ?>
        <div class="alert alert-success" role="alert">
        <strong>STTPP<?php echo " ".$_SESSION['jenisdiklat']." ".$_SESSION['namadiklat']." Angkatan ".$_SESSION['angkatan']." " ?>sudah diunggah.</strong>
        <a href="<?php echo base_url().$dok_sttpp ?>">Klik disini</a> untuk mengunduh file STTPP tersebut.
        </div>
        <!--<a href="javascript:;" class="edit-record" data-id="<?php echo $_SESSION['id_pengajuan'] ?>" data-toggle="modal" data-target="#modal-revisi"> Revisi STTPP</a>-->
    <?php
        }
    }
}
?>
</div>
</div>

<!-- modal revisi-->
<div id="modal-revisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Revisi STTPP</h4>
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