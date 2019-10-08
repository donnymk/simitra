<div class="container-fluid isi">
    <!-- tampilkan STTPP yang sudah diupload -->
    <div class="table-responsive">
        <table class="table">
        <tr>
            <td colspan="9"><h4>Daftar STTPP</h4></td>
        </tr>
        <tr>
            <th>No.</th><th>Jenis pelatihan</th><th>Nama pelatihan & angkatan</th><th>Dokumen STTPP</th>
        </tr>
        <?php
        $no=1;
        foreach($user as $hasil){
            $id_user = $hasil->id;
        }
        //query untuk menampilkan data proposal
        $jalan = $this->Model_kabkota->tampil_sttpp($id_user)->result_array();
        //untuk memeriksa jumlah baris
        $jmlbaris = $this->Model_kabkota->tampil_sttpp($id_user)->num_rows();
        //jika data ditemukan
        foreach($jalan as $row){
            $jenisdiklat = $row['jenisdiklat'];
            $namadiklat = $row['namadiklat'];
            $angkatan = $row['angkatan'];
            $id_dok_sttpp = $row['id_dok_sttpp'];
            $dok_sttpp = $row['dok_sttpp'];
            $tgl_terbit = $row['tgl_terbit'];
        ?>
            <tr>
                <td><?= $no ?></td><td><?= $jenisdiklat ?></td>
                <td><?= $namadiklat." Angkatan ".$angkatan ?><br></td>
                <td>
                <a class="btn btn-success btn-sm "href="<?= base_url().$dok_sttpp ?>"><span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span> Unduh</a>
                <br><sub>Diterbitkan pada <?= $tgl_terbit ?> </sub>
                </td>
                <td>
                </td>
            </tr>
            <?php
            $no++;
        }

        //jika data tidak ada dalam database
        if ($jmlbaris==0){
        ?>
            <tr>
                        <td colspan="8"><center>Belum ada STTPP yang terbit</center></td>
                </tr>
        <?php
        }
        ?>
    </table>
    </div>
</div>