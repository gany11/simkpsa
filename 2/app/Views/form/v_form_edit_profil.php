<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('profil')?>">Profil</a></li>
                <li class="breadcrumb-item active">Edit Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form class="form-horizontal" action="<?= base_url('profil/edit/save'); ?>" method="post">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNama" placeholder="Masukkan nama Anda" name="nama" <?= (session()->get('nama') ? 'value="' . esc(session()->get('nama')) . '"' : '') ?> required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputUsername" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputUsername" placeholder="Masukkan username Anda" name="username" <?= (session()->get('username') ? 'value="' . esc(session()->get('username')) . '"' : '') ?> required>
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