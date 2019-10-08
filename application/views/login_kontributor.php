<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>SIMITRA | BPSDMD Provinsi Jawa Tengah</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/animate.css">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="<?= base_url(); ?>css/normalize.css">
    <link rel="stylesheet" href="<?= base_url(); ?>style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/responsive.css">
    <script src="<?= base_url(); ?>js/vendor/modernizr-2.8.3.min.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">

    <div class="preloader">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!--Mainmenu-area-->
    <div class="mainmenu-area" data-spy="affix" data-offset-top="100">
        <div class="container">
            <!--Logo-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand logo">
                    <h2>SIMITRA</h2>
                </a>
            </div>
            <!--Logo/-->
            <nav class="collapse navbar-collapse" id="primary-menu">
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </nav>
        </div>
    </div>
    <!--Mainmenu-area/-->

    <footer class="footer-area relative sky-bg" id="contact-page">
        <div class="absolute footer-bg"></div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <br><br><br><br>
                        <h2>Login</h2>
                        <form method="post" class="contact-form">
                            <div class="form-group">
                                <input type="text" id="username" name="username" placeholder="Username" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                            </div>                            
                            <button type="submit" class="button" onclick="return check_login()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 pull-right">
                        <ul class="social-menu text-right x-left">
                            <li><a href="https://www.facebook.com/npsdmdjateng/" target="_blank"><i class="ti-facebook"></i></a></li>
                            <li><a href="https://twitter.com/bpsdmdjtg" target="_blank"><i class="ti-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/bpsdmdjtg" target="_blank"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p><a href="<?= site_url() ?>index.php/user" class="button btn-sm">Login sebagai Bidang Penyelenggara</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>&copy;Copyright 2018 All right resurved. <a href="https://bpsdmd.jatengprov.go.id">BPSDMD Provinsi Jawa Tengah </a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>





    <!--Vendor-JS-->
    <script src="<?= base_url(); ?>js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?= base_url(); ?>js/vendor/bootstrap.min.js"></script>
    <!--Plugin-JS-->
    <script src="<?= base_url(); ?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>js/contact-form.js"></script>
    <script src="<?= base_url(); ?>js/jquery.parallax-1.1.3.js"></script>
    <script src="<?= base_url(); ?>js/scrollUp.min.js"></script>
    <script src="<?= base_url(); ?>js/magnific-popup.min.js"></script>
    <script src="<?= base_url(); ?>js/wow.min.js"></script>
    <!--Main-active-JS-->
    <script src="<?= base_url(); ?>js/main.js"></script>
    
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
                    type:"post",
                    url: "<?= site_url('index.php/kabkota/cek_login') ?>",
                    data:dataString,
                    cache:false,
                    success: function(pesan){
                        if(pesan=='ok'){
                            //Arahkan ke halaman kab-kota jika script pemroses mencetak kata ok
                            window.location = "<?= site_url('index.php/kabkota') ?>";
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
