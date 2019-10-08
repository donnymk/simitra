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
	<!--<link href="<?= base_url(); ?>assets/css/TableZebra.css" rel="stylesheet">-->
        <link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/custom-navbar.css" rel="stylesheet">
    <style>
        .isi{
            min-height: 800px;
            
        }
        .box{
            padding-top: 10px;
            background-color: white;
        }
    </style>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
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
    <ul class="nav navbar-nav">
    <?php
    // Menu dibuat berbeda untuk user Kab / Kota dan user SKPD
    if($_SESSION['jenis_user'] == 'KABKOT'){
    ?>
        <li class="dropdown <?= $aktif_menu1_0 ?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Pengajuan Proposal <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li class="<?= $aktif_menu1_1 ?>"><a href="<?= site_url('index.php/kabkota/pengajuan') ?>">Formulir</a></li>
                <li class="<?= $aktif_menu1_2 ?>"><a href="#">Unggah Peserta</a></li>
                <li class="<?= $aktif_menu1_3 ?>"><a href="<?= site_url('index.php/kabkota/lihat_sttpp') ?>">STTPP</a></li>
            </ul>
        </li>
        <li class="<?= $aktif_menu2_0 ?>">
            <a href="<?= site_url('index.php/kabkota/lihat_usulanujikomp') ?>">Usulan Uji Kompetensi</a>
        </li>        
    <?php
    }
    else{
    ?>
        <li class="<?= $aktif_menu2_0 ?>">
            <a href="<?= site_url('index.php/kabkota/lihat_usulanujikomp') ?>">Usulan Uji Kompetensi</a>
        </li>
    <?php
    }
    ?>

    </ul>
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