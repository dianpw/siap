<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('_partials/head.php'); ?>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b><?= $title;?> </b><?= SITE_NAME; ?></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      <?= $this->session->flashdata('message'); ?>

      <form action="<?= base_url('register'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="nama" class="form-control" placeholder="Nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?= form_error('nama', '<div class="input-group mb-3"><small class="text-danger">', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?= form_error('username', '<div class="input-group mb-3"><small class="text-danger">', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?= form_error('password', '<div class="input-group mb-3"><small class="text-danger">', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="password" name="repassword" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?= form_error('repassword', '<div class="input-group mb-3"><small class="text-danger">', '</small></div>'); ?>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?php echo base_url('login'); ?>" class="text-center">Already have an account?</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php $this->load->view('_partials/foot.php'); ?>
</body>
</html>
