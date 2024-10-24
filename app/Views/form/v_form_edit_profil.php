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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('profil/edit/save'); ?>" method="post">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Masukkan nama Anda" name="nama" <?= (session()->get('nama') ? 'value="' . esc(session()->get('nama')) . '"' : '') ?> required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Masukkan username Anda" name="username" <?= (session()->get('username') ? 'value="' . esc(session()->get('username')) . '"' : '') ?> required>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                    </div>
                                <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->