<!DOCTYPE html>
<html>
<head>  
  <?php $this->load->view('_partials/head.php'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Profile</a>
      </li>    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item breadcrumb-item"><a href="<?= base_url('home');?>">Home</a></li>
      <li class="nav-item breadcrumb-item active"><?= $title;?> Profile</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('_partials/menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= base_url();?>assets/dist/img/profile/<?= $profil['foto'];?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $profil['nama'];?></h3>

                <p class="text-muted text-center"><?= $profil['role'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?php if($profil['status'] == 1){ echo "Aktif";}else{ echo "Non Aktif";} ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>NRG</b> <a class="float-right"><?= $profil['nrg'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Telp</b> <a class="float-right"><?= $profil['telp'];?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!--li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li-->
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!--div class="active tab-pane" id="activity">
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url();?>assets/dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div-->
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Logs</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; foreach ($logs as $log){ ?>
                        <tr>
                          <td><?= date('d-m-Y',strtotime($log->update_data));?></td>
                          <td><?= $log->log;?></td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                    <!-- The timeline -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="<?= base_url('profile'); ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">NRG</label>
                        <div class="col-sm-10">
                          <input type="tect" class="form-control" placeholder="NRG" value="<?= $profil['nrg'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $profil['nama'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-10">
                          <input type="text" name="telp" class="form-control" placeholder="Telp" value="<?= $profil['telp'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" placeholder="New Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Re-Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="repassword" class="form-control" placeholder="Re-Password">
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <label for="inputName2" class="col-sm-2 col-form-label">Foto Profile</label>
                        <div class="col-sm-10">                          
                          <img class="profile-user-img img-fluid " src="<?= base_url();?>assets/dist/img/profile/<?= $profil['foto'];?>" alt="User profile picture">
                          <div class="custom-file" style="margin-top: 10px;">
                          <input type="hidden" name="old_foto" value="<?= $profil['foto'];?>" />
                            <input type="file" class="custom-file-input" id="foto" name="foto">
                            <label class="custom-file-label" for="foto">Choose file</label>
                          </div>  
                        </div>                      
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('_partials/footer.php'); ?>  
</div>
<!-- ./wrapper -->
<?php $this->load->view('_partials/foot.php'); ?>

<!-- DataTables -->
<script src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
