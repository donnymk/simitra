<!DOCTYPE  html>
<html>
<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SIMITRA | BPSDMD Provinsi Jawa Tengah</title>
		<link href="<?= base_url(); ?>assets/images/logo_jawa_tengah_icon.ico" rel="icon" type="image/x-icon">
        <!-- CSS -->
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/TableZebra.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/custom-navbar.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-trans navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
	  <a class="navbar-brand" href="#">SIMITRA</a>
</div>
</div>
</nav>

<div class="container">
    <div class="content">
        <div id="msg" style="min-height: 50px"></div>
       <form method="post">
        <center>
        <table>
            <tr>
                <td colspan="2"><h4>MASUK (ADMIN)</h4></td>
            </tr>
            <tr>
                <td>
                    <img src="<?= base_url(); ?>assets/images/Logo-Jawa+Tengah.png" width="128" height="142" alt="">
                </td>
                <td>
                    <div class="form-group">
                        <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Username<br/>
                        <input class="form-control" id="username" name="username" type="text" required>
                    </div>
                    <div class="form-group">
                        <span class='glyphicon glyphicon-lock' aria-hidden='true'></span> Password<br/>
                        <input class="form-control" id="password" name="password" type="password" required>
                    </div>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary" name="submit" onclick="return check_login()">
            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Masuk</button>
        </center>
        </form>
	</div>
</div>
<br>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

    <script>
        function check_login() {
            var username=document.getElementById('username').value;
            var password=document.getElementById('password').value;
            var dataString='username='+ username + '&password='+password;
            if (username==""){
                $('#username').focus();
                //return true;
            }
            else if (password==""){
                $('#password').focus();
                //return true;
            }
            else{
                //Ubah tulisan pada elemen <p> saat click login
                $('#msg').html('<center><br><label>Silakan tunggu ...</label></center>');
                $.ajax({
                    type:"POST",
                    url: "<?= site_url('index.php/admin/cek_login_admin') ?>",
                    data:dataString,
                    cache:false,
                    success: function(pesan){
                        if(pesan=='ok'){
                            //Arahkan ke halaman kab-kota jika script pemroses mencetak kata ok
                            window.location = "<?= site_url('index.php/admin') ?>";
                        }
                        else{
                            //Cetak peringatan untuk username & password salah
                            $('#msg').html(pesan);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#msg').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('errorThrown:');
                        console.log(errorThrown);
                    } 
                });
                return false;
            }
        }
    </script>
</body>
</html>