<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('pengeluaran')?>">Pengeluaran</a></li>
                <li class="breadcrumb-item active"><?=$title?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form class="form-horizontal" action="<?= base_url('pengeluaran/save'); ?>" method="post">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= (empty($pengeluaran) ? '' : $pengeluaran['id']); ?>">

                        <div class="form-group row">
                            <label for="inputTanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputTanggal" 
                                    name="date" 
                                    value="<?= (empty($pengeluaran) ? '' : $pengeluaran['date']); ?>" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descSelect" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="desc" id="descSelect" onchange="toggleOtherInput(this)">
                                    <option value="">Pilih Deskripsi</option>
                                    <?php foreach ($uniqueDescriptions as $description) : ?>
                                        <option value="<?= esc($description); ?>" <?= (!empty($pengeluaran) && $pengeluaran['desc'] === $description) ? 'selected' : ''; ?>>
                                            <?= esc($description); ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="Lainnya" <?= (!empty($pengeluaran) && $pengeluaran['desc'] === 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                                <input type="text" class="form-control" id="otherDescInput" name="other_desc" placeholder="Masukkan Deskripsi Lainnya" style="display: none;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputNominal" class="col-sm-2 col-form-label">Nominal (Rupiah)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputNominal" 
                                    placeholder="Masukkan Nominal" 
                                    name="nominal" 
                                    value="<?= (empty($pengeluaran) ? '' : $pengeluaran['nominal']); ?>" 
                                    step="0.01" 
                                    required>
                            </div>
                        </div>

                        <script>
                            function toggleOtherInput(select) {
                                const otherInput = document.getElementById('otherDescInput');
                                otherInput.style.display = (select.value === 'Lainnya') ? 'block' : 'none';
                                otherInput.required = (select.value === 'Lainnya');
                            }

                            document.querySelector('form').addEventListener('submit', function(event) {
                                const descSelect = document.getElementById('descSelect');
                                if (descSelect.value === '') {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Peringatan!',
                                        text: 'Silakan pilih deskripsi sebelum mengirimkan form.',
                                        icon: 'warning',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        </script>
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