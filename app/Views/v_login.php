<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT Perta Sakti Abadi | Login</title>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url('favicon.ico');?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css');?>">
  <style>
    body {
    background-image: url('<?php echo base_url('assets/images/bag.png');?>');
    background-repeat: no-repeat;
    }
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-light">
    <div class="card-header text-center">
      <h1><b>LOGIN</b></h1>
      <h6>Sistem Informasi Manajemen Keuangan</h6>
      <h6>PT Perta Sakti Abadi</h6>
    </div>
    <div class="card-body">
      <!-- <marquee><p class="login-box-msg">Selamat Datang! Silahkan masuk untuk memulai sesi Anda!</p></marquee> -->
      <?php
        if(!empty(session()->getFlashdata('error'))) {
            echo  '<div class="alert alert-danger d-flex align-items-center text-center" role="alert">
                    '.session()->getFlashdata('error').'
                  </div>';
        } elseif (!empty(session()->getFlashdata('sukses'))) {
          echo  '<div class="alert alert-success d-flex align-items-center text-center" role="alert">
                  '.session()->getFlashdata('sukses').'
                </div>';
        }
      ?>
      <form action="<?= base_url('login/in'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <h6 class="text-center pb-3"><strong>&copy; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script> PT Perta Sakti Abadi.</strong>
    All rights reserved.</h6>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
