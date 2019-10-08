<div class="container-fluid isi">
    <h2>Daftar Usulan Uji Kompetensi</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">          
            <!-- tampilkan usulan uji kompetensi -->
            <div class="table-responsive">
                <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Kab / Kota / SKPD</th>
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
                    $kabupatenkota = $row['kabupatenkota'];
                ?>
                    <tr>
                        <td><?= $no ?> </td>
                        <td><?= $kabupatenkota ?></td>
                        <td><?= $jenis_ujikom ?></td>
                        <td><?= $nama_jabatan ?></td>
                        <td><?= $nama_jenjang ?></td>
                        <td>
                            <?= $jumlah_peserta ?> | <a href="javascript:void(0)" onclick="viewpeserta('<?= $id_usulan_ujikom ?>', '<?= $nama_jabatan ?>')">Peserta</a>
                        </td>
                        <td><sub><?= $tgl_usul ?></sub></td>
                        <td>
                            <a class="btn btn-default btn-sm" href="<?= site_url('index.php/user/del_usulan_ujikomp/'.$id_usulan_ujikom) ?>" title="Hapus usulan" onclick="return confirm('Hapus?')">
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
            <table class="table table-bordered" id="dataTable-example">
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

    <!-- Datatables JS -->
    <script src="<?= base_url('plugins/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugins/dataTables/DataTables-1.10.16/js/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    
     <script src="<?= base_url('plugins/dataTables/Buttons-1.5.0/js/dataTables.buttons.min.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/Buttons-1.5.0/js/buttons.jqueryui.min.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/JSZip-2.5.0/jszip.min.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/pdfmake-0.1.32/pdfmake.min.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/pdfmake-0.1.32/vfs_fonts.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/Buttons-1.5.0/js/buttons.html5.min.js'); ?>" type="text/javascript"></script>
     <script src="<?= base_url('plugins/dataTables/Buttons-1.5.0/js/buttons.print.min.js'); ?>" type="text/javascript"></script>
     
    <script>
        function inisialisasi_datatable(){
            $('#dataTable-example').dataTable({
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                "pageLength": 10,
                "language": {
                    "url": "<?= base_url('plugins/dataTables/Indonesian.json') ?>"
                },                   
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5'
                    },
                    {
                        extend: 'csvHtml5'
                    }, 
                    {
                        extend: 'excelHtml5'
                    },
                    {
                        extend: 'pdfHtml5'
                    }, 
                    {
                        extend: 'print'
                    } 
                ]               
            });            
        }
        function viewpeserta(idusulanujikomp, namaujikomp){
            $('#nama-ujikomp').html(namaujikomp);
            // reset datatables
            $("#dataTable-example").DataTable().destroy();
            //load data peserta       
            $.ajax({
                url: '<?= site_url('index.php/kabkota/load_peserta_ujikomp') ?>',
                type: 'POST',
                data: 'idusulanujikomp='+idusulanujikomp,
                async: true,
                cache:true,
                success: function(a){
                    $('#data-pns').html(a);
                    inisialisasi_datatable();
                }
            });            
        }
    </script>