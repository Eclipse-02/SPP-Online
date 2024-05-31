<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SMPTQ AL IKHLAS</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/png" href="<?php echo media_url('img/smplogo.png') ?>">

  <link href="<?php echo media_url() ?>css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo media_url() ?>css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?php echo media_url() ?>css/login.css" rel="stylesheet" />
</head>
<body>


  <div class="row">
    <div class="col-md-5">
      <div class="logo hidden-xs hidden-sm">
        <?php if (isset($setting_logo) AND $setting_logo['setting_value'] == NULL) { ?>
        <img src="<?php echo media_url('img/smplogo.png') ?>" class="img-responsive">
        <?php } else { ?>
        <img src="<?php echo upload_url('school/' . $setting_logo['setting_value']) ?>" class="img-responsive">
        <?php } ?>
      </div>
      <p class="merk"><span style="color: #0185e3;">Sistem Informasi Pembayaran</span> </p> 
      <?php if (isset($setting_school) AND $setting_school['setting_value'] == '-') { ?>
      <p class="school">Sistem Informasi Pembayaran </p> 
      <?php } else { ?>
      <p class="school"><?php echo $setting_school['setting_value'] ?></p> 
      <?php } ?>
    </div>
    <div class="col-md-7">
      <div class="box">
        <?php echo form_open('manage/auth/login', array('class'=>'login100-form validate-form')); ?>

        <div class="col-md-12">
          <p class="title-login">Login Petugas</p>
          <?php if ($this->session->flashdata('failed')) { ?>
          <br><br>
        <!-- <div class="alert alert-info alert-dismissible" style="margin-top: -85px !important;">
          <h5><i class="fa fa-info"></i>  Login menggunakan email</h5>
        </div> -->
        <?php  }  ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" required="" autofocus="" name="email" placeholder="Masukan email" class="form-control flat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" required="" name="password" placeholder="Masukan password" class="form-control flat">
              </div>
            </div>
          </div>
          <button class="btn btn-success">Login</button>
          <button onclick="location.href='<?php echo site_url('/') ?>'" class="btn btn-info">Masuk sebagai siswa</button>
        </div>
        
        <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>


</body>
</html>
