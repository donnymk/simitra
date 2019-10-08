<div class="container-fluid content">
<!-- Kolom untuk pengaturan kab / kota -->
<div class="col-lg-5">
<center>
<table>
    <tr><td colspan='4'>Kabupaten / Kota</td></tr>
    <tr>
        <th></th>
        <th><sub>Username</sub></th>
        <th><sub>Password</sub></th>
        <th></th>
    </tr>
    <?php
        //$query="SELECT * FROM kabkota";
        $kabkota=$this->Model_admin->tampil_kabkota()->result_array();
        foreach($kabkota as $row){
            $id_kabkota = $row['id'];
            $namakota = $row['nama'];
            $user = $row['kode'];
            $password = $row['password'];
    ?>
    <form method='post' action='<?= site_url('admin/update_kabkota') ?>' role="form">
    <tr>
        <td><b><?= $namakota ?></b></td>
        <td>
        <input type='hidden' name='id_kabkota' value='<?= $id_kabkota ?>'>
        <input type='text' class='form-control input-sm' name='user' value='<?= $user ?>' required>
        </td>
        <td>
        <input type='text' class='form-control input-sm' name='password' value='<?= $password ?>' required>
        </td>
        <td><button type='submit' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Perbarui</button></td>
    </tr>
    </form>
    <?php
    }
    ?>
</table>
<a href="javascript:;" data-id="" data-toggle="modal" data-target="#modal-tambah-kabkota"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambah</a>
</center>
</div>

<!-- Kolom untuk pengaturan bidang teknis -->
<div class="col-lg-7">
<center>
<table>
    <tr><td colspan='4'>Bidang</td></tr>
	<tr>
            <th>Nama</th>
            <th><sub>Username</sub></th>
            <th><sub>Password</sub></th>
            <th></th>
        </tr>
<?php
$cariuser = $this->Model_admin->tampil_user()->result_array();
foreach($cariuser as $row){
       $id_user = $row['id_user'];
	   $user = $row['user'];
	   $password = $row['password'];
       $nama = $row['nama'];
?>
<form method='post' action='<?= site_url('index.php/admin/update_user') ?>' role="form">
    <tr>
		<td>
        <input type='hidden' name='id_user' value='<?= $id_user ?>'>
        <input type='text' class='form-control' name='nama' value='<?= $nama ?>' required></td>
        <td><input type='text' class='form-control input-sm' name='user' value='<?= $user ?>' required></td>
		<td>
        <input type='text' class='form-control input-sm' name='password' value='<?= $password ?>' required>
        </td>
		<td><button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Perbarui</button></td>
	</tr>
</form>
<?php
}
?>
</table>
<a href="javascript:;" data-id="" data-toggle="modal" data-target="#modal-tambah-user"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambah</a>
</center>
</div>

<!-- Kolom untuk pengaturan admin -->
<div class="col-lg-12">
<center>
<form method='post' action='<?= site_url('admin/update_admin') ?>' role="form">
<table>
    <tr><td colspan='3'>Admin</td></tr>
	<tr><th><sub>Username</sub></th><th><sub>Password</sub></th><th></th></tr>
<?php
$cariadmin = $this->Model_admin->tampil_admin()->result_array();
foreach($cariadmin as $row){
       $id_admin = $row['id_admin'];
	   $user = $row['user'];
	   $password = $row['password'];
?>
    <tr>
        <td>
        <input type='hidden' name='id_admin' value='<?= $id_admin ?>'>
        <input type='text' class='form-control input-sm' name='user' value='<?= $user ?>' required></td>
		<td>
        <input type='password' id='password' class='form-control input-sm' name='password' value='<?= $password ?>' required>
        </td>
		<td><button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Perbarui</button></td>
	</tr>
<?php
}
?>
</table>
</form>
</center>
</div>

</div>

<!-- modal tambah Kabupaten / Kota-->
<div id="modal-tambah-kabkota" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Kabupaten / Kota</h4>
            </div>
            <div class="modal-body" align="center">
                <form action="<?= site_url('admin/save_kabkota') ?>" method="post" role="form">
                    <div class="form-group form-inline">
                    <select type="text" name="kabkota" class="form-control" required>
                    <option value="">--Pilih--</option>
                    <option value="Kabupaten">Kabupaten</option>
                    <option value="Kota">Kota</option></select>
                    <input type=text name="namakabkota" class="form-control" placeholder="contoh: Kudus" required>
                    </div>
                    <div class="form-group form-inline">
                    <strong>Username </strong><input type=text name="nama" class="form-control" required>
                    </div>
                    <div class="form-group form-inline">
                    <strong>Password </strong><input type=password name="password" class="form-control" required>
                    </div>
                <button class="btn btn-danger" type="submit" name="submit">
                <span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah bidang teknis-->
<div id="modal-tambah-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Bidang Teknis</h4>
            </div>
            <div class="modal-body" align="center">
                <form action="<?= site_url('admin/save_user') ?>" method="post" role="form">
                    <div class="form-group form-inline">
                    <strong>Nama </strong><input type=text name="nama" class="form-control" required>
                    </div>
                    <div class="form-group form-inline">
                    <strong>Username </strong><input type=text name="user" class="form-control" required>
                    </div>
                    <div class="form-group form-inline">
                    <strong>Password </strong><input type=password name="password" class="form-control" required>
                    </div>
                <button class="btn btn-danger" type="submit" name="submit">
                <span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/js/password.js"></script>
<script>
    $(function() {
        $('#password').password().on('show.bs.password', function(e) {
            $('#eventLog').text('On show event');
            $('#methods').prop('checked', true);
        }).on('hide.bs.password', function(e) {
                    $('#eventLog').text('On hide event');
                    $('#methods').prop('checked', false);
                });
        $('#methods').click(function() {
            $('#password').password('toggle');
        });
    });
</script>