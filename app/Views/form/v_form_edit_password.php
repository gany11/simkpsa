<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('profil')?>">Profil</a></li>
                <li class="breadcrumb-item active">Edit Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form class="form-horizontal" action="<?= base_url('password/edit/save'); ?>" method="post">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputPasswordLama" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPasswordLama" placeholder="Masukkan password lama Anda" name="passwordlama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPasswordBaru" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPasswordBaru" placeholder="Masukkan password baru Anda" name="passwordbaru" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputKonfirmasiPassword" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputKonfirmasiPassword" placeholder="Konfirmasi password baru Anda" name="konfirmasipasswordbaru" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="d-flex">
                        <button type="button" class="btn btn-default flex-fill m-3" onclick="window.history.back();">Batal</button>
                        <button type="submit" class="btn btn-primary flex-fill m-3">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->