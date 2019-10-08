<div class="container-fluid isi">
    <h2>Formulir Usulan Uji Kompetensi</h2>
    <hr>
    <div class="row">
        <!--Kolom untuk pemberitahuan ketika pesan berhasil atau gagal upload proposal-->
        <div id="msg" class="col-md-12">
        <?php
        foreach($user as $hasil){
        $id_user = $hasil->id;
        }
        //script untuk upload proposal jika submit button diklik
        //$this->Model_kabkota->upload_proposal();
        ?>
        </div>
        
        <form id="uploadForm" method="post" role="form" action="input_usulanujikomp">
            <!-- Kolom untuk form input usulan -->
            <div class="col-lg-4">
                <div class="form-group">
                    <strong>Jenis Uji Kompetensi *</strong><br/>
                    <input type="hidden" name="idkabkota" value="<?= $id_user ?>">
                    <select type="text" id="jenisujikomp" class="form-control" name="jenisujikomp" required>
                        <option disabled="" selected="">--Pilih--</option>
                        <?php
                        foreach ($jenisujikomp as $obj){
                            echo '<option value="'.$obj -> id_jenis_ujikom.'">'.$obj -> jenis_ujikom.'</td>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <strong>Jabatan yang akan diuji kompetensikan *</strong><br/>
                    <select type="text" id="idjabatan" class="form-control" name="idjabatan" required>
                    </select>
                </div>
                <div class="form-group" id="selectjenjang">
                    <strong>Jenjang *</strong><br/>
                    <select type="text" id="idjenjangjabatan" class="form-control" name="idjenjangjabatan">
                    </select>
                </div>
                <div class="form-group">
                    <strong>Jumlah ASN yang akan diuji kompetensikan *</strong><br/>
                    <input type="number" id="jmlasn" class="form-control" name="jmlasn" placeholder="misal: 10" min="1" max="99" value="1" required>
                </div>
                <div class="form-group">
                    <a id="next" class="btn btn-default" name="next">
                        Selanjutnya
                    </a>
                </div>
            <br>
            </div>
            <div class="col-lg-8">
                <div id="container-pns">
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>NIP *</strong><br/>
                                <input type="text" id="nippns[]" class="form-control" name="nippns[]" placeholder="NIP tanpa spasi" required>
                            </div>
                            <div class="col-md-6">
                                <strong>Nama *</strong><br/>
                                <input type="text" id="namapns[]" class="form-control" name="namapns[]" required>
                            </div>                        
                        </div>
                    </div>
                    <div class="form-group">
                        <strong>Jabatan *</strong><br/>
                        <input type="text" id="jabatanpns[]" class="form-control" name="jabatanpns[]" required>
                    </div>
                    <div class="form-group">
                        <strong>OPD *</strong><br/>
                        <input type="text" id="opdpns[]" class="form-control" name="opdpns[]" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="tipepns[]" class="form-control" name="tipepns[]" value="" required>
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>-->
                </div>
                <div class="form-group" id="div-submit">
                        <button id="submit" type="submit" class="btn btn-danger btn-lg" name="submit">
                            <span class="fa fa-send-o"></span> Submit
                        </button>
                    </div>
            </div>
        </form>
    </div>
</div>
    <script>
        function listnamajabatan(){
            var jenisujikomp = $('#jenisujikomp').val();
            $.ajax({
                url: '<?= site_url('index.php/kabkota/load_jabatan') ?>',
                type: 'POST',
                data: 'jenisujikomp='+jenisujikomp,
                async: true,
                cache:true,
                success: function(a){
                    $('#idjabatan').html(a);
                    //jika jenis uji kompetensi adalah Kenaikan Jenjang, load daftar jenjang
                    if(jenisujikomp === '2'){
                        $('#selectjenjang').show();
                        var idjabatan = $('#idjabatan').val();        
                        $.ajax({
                            url: '<?= site_url('index.php/kabkota/load_jenjang') ?>',
                            type: 'POST',
                            data: 'idjabatan='+idjabatan,
                            async: true,
                            cache:true,
                            success: function(b){
                                $('#idjenjangjabatan').html(b);
                            }
                        });                        
                    }
                    else{
                        $('#selectjenjang').hide();
                    }
                }
            });
        }
        //ambil data PNS dari web service
        function submitnip(urutan){
            var nip = $('input[name="nippns'+urutan+'"]').val();
        <?php
        if($_SESSION['jenis_user'] == 'KABKOT'){
        ?>
            $.ajax({
                url: '<?= site_url('index.php/kabkota/get_datapns_kabkota') ?>',
                type: 'POST',
                data: 'nip='+nip,
                async: true,
                cache:true,
                success: function(b){
                    var json = JSON.parse(b);
                    $('input[name="namapns'+urutan+'"]').val(json.nama);
                    $('input[name="jabatanpns'+urutan+'"]').val(json.jabatan);
                    $('input[name="opdpns'+urutan+'"]').val(json.unitkerja);
                }
            });
        <?php
        }
        else{
        ?>
            $.ajax({
                url: '<?= site_url('index.php/kabkota/get_datapns_pemprov') ?>',
                type: 'POST',
                data: 'nip='+nip,
                async: true,
                cache:true,
                success: function(b){
                    var json = JSON.parse(b);
                    $('input[name="namapns'+urutan+'"]').val(json.nama);
                    $('input[name="jabatanpns'+urutan+'"]').val(json.jabatan);
                    $('input[name="opdpns'+urutan+'"]').val(json.instansi);
                }
            });        
        <?php
        }
        ?>            
        }
        
        $(document).ready(function(){        

           listnamajabatan();
           
           $('#jenisujikomp').on('change',function(){
               listnamajabatan();
           });
           
           $('#idjabatan').on('change',function(){
                //load data jenjang
                var idjabatan = $('#idjabatan').val();        
                $.ajax({
                    url: '<?= site_url('index.php/kabkota/load_jenjang') ?>',
                    type: 'POST',
                    data: 'idjabatan='+idjabatan,
                    async: true,
                    cache:true,
                    success: function(b){
                        $('#idjenjangjabatan').html(b);
                    }
                });         
           });
           
           //sembunyikan tombol submit
           $('#div-submit').hide();
            $("#next").on('click', function(){
                var jml_asn = $('#jmlasn').val();
                var div_asn ='';
                for(urutan=0; urutan<jml_asn; urutan++){
                    div_asn += '<div class="form-group"><div class="row"><div class="col-md-6"><strong>NIP *</strong> <br/> <div class="input-group"> <input type="text" class="form-control" name="nippns'+urutan+'" placeholder="NIP tanpa spasi"> <span class="input-group-btn"><button class="btn btn-default" onclick="submitnip(\''+urutan+'\')" type="button">Cek</button> </span></div><!-- /input-group --></div><div class="col-md-6"> <strong>Nama *</strong> <br/> <input type="text" id="namapns[]" class="form-control" name="namapns'+urutan+'" required> </div></div></div><div class="form-group"> <strong>Jabatan *</strong> <br/> <input type="text" id="jabatanpns[]" class="form-control" name="jabatanpns'+urutan+'" required> </div><div class="form-group"> <strong>OPD *</strong> <br/> <input type="text" id="opdpns[]" class="form-control" name="opdpns'+urutan+'" required> </div><div class="form-group"> <input type="hidden" id="tipepns[]" class="form-control" name="tipepns'+urutan+'" value="" required> </div><div class="form-group"><hr></div>';
                }
                $('#container-pns').html('<h4>Masukkan data ASN</h4>' + div_asn);
                //tampilkan tombol submit
                $('#div-submit').show();
            });
        });
    </script>