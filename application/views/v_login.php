
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login Aplikasi Stok Opname Logistik</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/css/util.css">
<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v18/css/main.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet"></link>

<meta name="robots" content="noindex, follow">
</head>
<body style="background-color: #666666;">
<div class="limiter">
<div class="container-login100">
<div class="wrap-login100">
<form class="login100-form validate-form" style="margin-top: -90px;" action="<?php echo base_url(); ?>auth/signin" method="post">
<span class="login100-form-title p-b-43">
<center><img src="<?php echo base_url(); ?>assets/POLRES.png" width="20%"  height="10%"></center>
    Login Aplikasi Stok Opname Gudang Logistik POLRES Pesawaran
</span>
<div class="wrap-input100 validate-input" data-validate="Username is required">
<input class="input100" type="text" name="username">
<span class="focus-input100"></span>
<span class="label-input100">Username</span>
</div>
<div class="wrap-input100 validate-input" data-validate="Password is required">
<input class="input100" type="password" name="password">
<span class="focus-input100"></span>
<span class="label-input100">Password</span>
</div>

<div class="container-login100-form-btn">
<button class="login100-form-btn" style="background-color: #00a65a;" type="submit">
Login
</button>
</div>

</form>
<div class="login100-more" style="background-size: 80% 50%; background-image: url('<?php echo base_url(); ?>assets/bglogin.svg');">
</div>
</div>
</div>
</div>

<script src="https://colorlib.com/etc/lf/Login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/animsition/js/animsition.min.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/bootstrap/js/popper.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/select2/select2.min.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/daterangepicker/moment.min.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/daterangepicker/daterangepicker.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/vendor/countdowntime/countdowntime.js"></script>
<script src="https://colorlib.com/etc/lf/Login_v18/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script type='text/javascript'>
<?php if($this->session->flashdata('error1') == 'failpassword') { ?>
    swal("Login Gagal","Cek kembali password anda !","error");
<?php }else if($this->session->flashdata('error2') == 'failaccount') { ?>
    swal("Login Gagal","Cek kembali username dan password anda !","error");
<?php } ?>
</script>
</body>
</html>
