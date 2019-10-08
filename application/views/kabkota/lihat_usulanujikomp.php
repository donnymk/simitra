<?php
foreach($user as $hasil){
    $kontributor = $hasil->nama;
}
?>
<div class="container-fluid isi">
    <h2>Usulan Uji Kompetensi oleh <?= $kontributor ?></h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-danger" href="<?= site_url('index.php/kabkota/usulan_uji_komp') ?>">
                <span class="fa fa-plus"></span> Usulkan Uji Kompetensi...
            </a>
            <p></p>
            <!-- tampilkan usulan uji kompetensi -->
            <div class="table-responsive">
                <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Jenis Uji Kompetensi</th>
                    <th>Nama Jabatan</th>
                    <th>Jenjang</th>
                    <th>Jumlah Peserta</th>
                    <th>Timestamp</th>
                </tr>
                <?php
                $no=1;
                //jika data ditemukan
                foreach($usulanujikomp as $row){
                    $id_usulan_ujikom = $row['id_usulan_ujikom'];
                    $jenis_ujikom = $row['jenis_ujikom'];
                    $nama_jabatan = $row['nama_jabatan'];
                    $nama_jenjang = $row['nama_jenjang'];
                    $jumlah_peserta = $row['jumlah_peserta'];
                    $tgl_usul = $row['tgl_usul'];
                ?>
                    <tr>
                        <td>
                            <?= $no ?>
                        </td>
                        <td><?= $jenis_ujikom ?></td>
                        <td><?= $nama_jabatan ?></td>
                        <td><?= $nama_jenjang ?></td>
                        <td>
                            <?= $jumlah_peserta ?> | <a href="javascript:void(0)" onclick="viewpeserta('<?= $id_usulan_ujikom ?>')">Peserta</a>
                        </td>
                        <td><sub><?= $tgl_usul ?></sub></td>
                        <td>
                            <a class="btn btn-default btn-sm" href="<?= site_url('index.php/kabkota/del_usulan_ujikomp/'.$id_usulan_ujikom) ?>" title="Hapus usulan" onclick="return confirm('Hapus?')">
                                <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
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
                    <td colspan="8"><center>Belum ada usulan uji kompetensi</center></td>
                </tr>
                <?php
                }
                ?>
            </table>
            </div>            
        </div>
        
        <div class="col-md-6">
            <h4>Daftar Peserta Uji Kompetensi <span id="nama-ujikomp"></span></h4>
            <table class="table table-bordered">
                <thead>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>OPD</th>
                </thead>
                <tbody id="data-pns">
                    
                </tbody>
            </table>
        </div>
    </div>

</div>

    <script>
        function viewpeserta(idusulanujikomp){
            //load data peserta       
            $.ajax({
                url: '<?= site_url('index.php/kabkota/load_peserta_ujikomp') ?>',
                type: 'POST',
                data: 'idusulanujikomp='+idusulanujikomp,
                async: true,
                cache:true,
                success: function(a){
                    $('#data-pns').html(a);
                }
            });            
        }
    </script>