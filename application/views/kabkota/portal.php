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
        <link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/custom-navbar.css" rel="stylesheet">
    <style>
        .isi{
            min-height: 800px
        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-trans navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    <span class="sr-only">Toggle navigation</span>
    <span>Menu</span>
    </button>
    <a class="navbar-brand" href="./">SIMITRA</a>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
        <?php
        foreach($user as $hasil){
            $kontributor = $hasil->nama;
        }
        echo "$kontributor";
        ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
	    <li><a href="<?= base_url(); ?>index.php/kabkota/logout"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Keluar</a></li>
        </ul>
        </li>
    </ul>
</div>
</div>
</nav>
<div class="container-fluid isi">
<?php
// Menu dibuat berbeda untuk user Kab / Kota dan user SKPD
if($_SESSION['jenis_user'] == 'KABKOT'){
?>
    <div class="row" style="text-align: center">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="<?= site_url('index.php/kabkota/pengajuan') ?>">
                <div class="alert alert-info">
                    <h1><span class="fa fa-book"></span></h1>
                    <h1>Pengajuan Proposal</h1>
                    <p>Pengajuan Proposal Penyelenggaraan Pelatihan</p>
                </div>
            </a>            
        </div>        
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="<?= site_url('index.php/kabkota/lihat_usulanujikomp') ?>">
                <div class="alert alert-info">
                    <h1><span class="fa fa-star"></span></h1>
                    <h1>Ujikom</h1>
                    <p>Usulan Uji Kompetensi</p>
                </div>
            </a>        
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal3">
                <div class="alert alert-info">
                    <h1><span class="fa fa-users"></span></h1>
                    <h1>SiMACAN</h1>
                    <p>Sistem Informasi Manajemen Camat</p>
                </div>
            </a>         
        </div>    
    </div>
    <div class="row" style="text-align: center">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal2">
                <div class="alert alert-info">
                    <h1><span class="fa fa-pencil"></span></h1>
                    <h1>Reg-Online</h1>
                    <p>Pendaftaran Peserta Pelatihan</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal1">
                <div class="alert alert-info">
                    <h1><span class="fa fa-line-chart"></span></h1>
                    <h1>Si Jari On AKD</h1>
                    <p>Hasil usulan kebutuhan pengembangan kompetensi</p>
                </div>
            </a> 
        </div>  
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="https://bpsdmd.jatengprov.go.id/pakwi/infoajar.php" target="_blank">
                <div class="alert alert-info">
                    <h1><span class="fa fa-calendar"></span></h1>
                    <h2>Info Tenaga Pengajar</h2>
                    <p>Informasi tenaga pengajar dari BPSDMD</p>
                </div>
            </a>
            
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal4">
                <div class="alert alert-info">
                    <h1><span class="fa fa-puzzle-piece"></span></h1>
                    <h2>Penyusunan Kurikulum Pelatihan Baru</h2>
                    <p></p>
                </div>
            </a>
            
        </div>
    </div>    
<?php
}
else{
?>
    <div class="row" style="text-align: center">        
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="<?= site_url('index.php/kabkota/lihat_usulanujikomp') ?>">
                <div class="alert alert-info">
                    <h1><span class="fa fa-star"></span></h1>
                    <h1>Ujikom</h1>
                    <p>Usulan Uji Kompetensi</p>
                </div>
            </a>        
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal2">
                <div class="alert alert-info">
                    <h1><span class="fa fa-pencil"></span></h1>
                    <h1>Reg-Online</h1>
                    <p>Pendaftaran Peserta Pelatihan</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal1">
                <div class="alert alert-info">
                    <h1><span class="fa fa-line-chart"></span></h1>
                    <h1>Si Jari On AKD</h1>
                    <p>Hasil usulan kebutuhan pengembangan kompetensi</p>
                </div>
            </a> 
        </div>        
    </div>
    <div class="row" style="text-align: center">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="" data-toggle="modal" data-target="#myModal4">
                <div class="alert alert-info">
                    <h1><span class="fa fa-puzzle-piece"></span></h1>
                    <h2>Penyusunan Kurikulum Pelatihan Baru</h2>
                    <p></p>
                </div>
            </a>
            
        </div>
    </div>
<?php    
}
?>
</div>
<br>
<footer>
  <div class="container-fluid">
    <p><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Jl. Setiabudi No. 201 A Semarang (50263) |
    <span class='glyphicon glyphicon-phone-alt' aria-hidden='true'></span> 024-7473066 |
    <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> <a href="mailto:bpsdmd@jatengprov.go.id?subject=">bpsdmd@jatengprov.go.id</a> |
    <span class='glyphicon glyphicon-globe' aria-hidden='true'></span><a href="http://bpsdmd.jatengprov.go.id" target="_blank"> bpsdmd.jatengprov.go.id</a></p>
  </div>
</footer>

  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Si Jari On AKD</h4>
        </div>
        <div class="modal-body">
          <p>Masih dalam tahap integrasi.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>    
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reg-Online</h4>
        </div>
        <div class="modal-body">
          <p>Masih dalam tahap integrasi.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>    
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SiMACAN</h4>
        </div>
        <div class="modal-body">
          <p>Masih dalam tahap integrasi.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>    
    </div>
  </div>
  
    <!-- Modal -->
  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Penyusunan Kurikulum Pelatihan Baru</h4>
        </div>
        <div class="modal-body">
          <p>Aplikasi masih dalam tahap pembangunan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>    
    </div>
  </div>
    
	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>