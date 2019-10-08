<div class="container-fluid isi">
    <h2>Tambah Jabatan</h2>
    <hr>
    <div class="row">    
        <form id="uploadForm" method="post" role="form" action="input_jabatan">
            <!-- Kolom untuk form input usulan -->
            <div class="col-lg-4">
                <div class="form-group">
                    <strong>Jenis Uji Kompetensi *</strong><br/>
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
                    <strong>Nama jabatan *</strong><br/>
                    <input type="text" class="form-control" name="namajabatan" required="">
                </div>
                <div class="form-group divjenjang">
                    <strong>Jumlah jenjang *</strong><br/>
                    <input type="number" id="jmljenjang" name="jmljenjang" class="form-control" min="1" max="5" value="1" required="">
                </div>                

            <br>
            </div>
            <div class="col-lg-8">
                <div class="form-group divjenjang" id="input-jenjang">
                    <strong>Jenjang *</strong><br/>
                    <input type="text" class="form-control namajenjangjabatan" name="namajenjang1" required="">
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
        $(document).ready(function(){
            //sembunyikan input jenjang
           $('.divjenjang').hide();
           
           $('#jenisujikomp').on('change',function(){         
               var jenisujikomp = $('#jenisujikomp').val();
               
               if(jenisujikomp == '1'){
                   $('.divjenjang').hide();
                   $('.namajenjangjabatan').removeAttr('required');
               }
               else{
                   $('.divjenjang').show();
                   $('.namajenjangjabatan').attr('required', '');
               }
           });
           
           
        $("#jmljenjang").on('change', function(){
            var jml_jenjang = $(this).val();
            var input_jenjang ='';
            input_jenjang += '<strong>Jenjang *</strong><br/>';
            for(jumlah=0; jumlah<jml_jenjang; jumlah++){
                input_jenjang += '<input type="text" class="form-control namajenjangjabatan" placeholder="Jenjang ke-'+(jumlah+1)+'"  name="namajenjang'+(jumlah+1)+'" required=""><br>';
            }
            $('#input-jenjang').html(input_jenjang);
        });
           
        });
    </script>