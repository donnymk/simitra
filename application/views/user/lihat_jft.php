<div class="container-fluid isi">
    <h2>Master Jabatan</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">          
            
            <select type="text" id="jenisujikomp" class="form-control" name="jenisujikomp" required>
                <option disabled="" selected="">--Pilih Jabatan untuk jenis uji kompetensi--</option>
                <?php
                foreach ($jenisujikomp as $obj){
                    echo '<option value="'.$obj -> id_jenis_ujikom.'">'.$obj -> jenis_ujikom.'</option>';
                }
                ?>
            </select>
            <br>
            <a class="btn btn-danger" href="<?= site_url('index.php/user/tambah_jft') ?>">
               <span class="fa fa-plus"></span> Tambahkan data Jabatan...
           </a>
            <p></p>
            <!-- tampilkan usulan uji kompetensi -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Jabatan</th>
                            <th>Jenjang</th>
                        </tr>                        
                    </thead>
                    <tbody id="data-jft">
                        
                    </tbody>
            </table>
            </div>            
        </div>
    </div>

</div>

    <script>
        function listnamajabatan(){
            var jenisujikomp = $('#jenisujikomp').val();
            $.ajax({
                url: '<?= site_url('index.php/user/load_jabatannjenjang') ?>',
                type: 'POST',
                data: 'jenisujikomp='+jenisujikomp,
                async: true,
                cache:true,
                success: function(a){
                    var datajft = JSON.parse(a);
                    var jmldata = datajft.length;
                    var counter;
                    var isidata = '';
                    for(counter=0; counter<jmldata; counter++){
                        isidata += '<tr><td>'+(counter+1)+'</td><td>'+datajft[counter].namajabatan+'</td><td>'+datajft[counter].jenjang+'</td></tr>';
                    }
                    $('#data-jft').html(isidata);
                }
            });
        }
        
        $(document).ready(function() {
           
           $('#jenisujikomp').on('change',function(){
               listnamajabatan();
           });
        });
    </script>