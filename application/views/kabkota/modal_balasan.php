<label>Admin:</label><br>
    <?php
    //query untuk menampilkan surat rekomendasi
    $jalan=$this->Model_kabkota->tampil_balasan()->result_array();
    foreach($jalan as $row){
    ?>
        <?php echo $row['ket'] ?><br><br>
        <a class='btn btn-success' href='<?= site_url().'/'.$row['surat'] ?>'>
        <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span> Unduh surat rekomendasi
        </a><br/>
        <sub>Diterbitkan pada <?php echo $row['tanggal_terbit'] ?></sub>
    <?php
    }
    ?>