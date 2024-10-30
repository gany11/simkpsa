<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                src="<?php echo base_url('assets/images/icon.png');?>"
                alt="PT Perta Sakti Abadi">
          </div>

          <h3 class="profile-username text-center">PT Perta Sakti Abadi</h3>

          <ul class="list-group list-group-unbordered m-3 mt-5 mb-3">
            <li class="list-group-item d-flex justify-content-between">
              <b>Nama</b> <span><?php echo session()->get('nama') ?? '';?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <b>Username</b> <span><?php echo session()->get('username') ?? '';?></span>
            </li>
          </ul>

          <div class="d-flex">
            <a href="<?php echo base_url('profil/edit')?>" class="btn btn-primary flex-fill m-3"><b>Edit Profil</b></a>
            <a href="<?php echo base_url('password/edit')?>" class="btn btn-primary flex-fill m-3"><b>Edit Password</b></a>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->