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
                <li class="breadcrumb-item"><a href="<?php echo base_url('pemasukan')?>">Pemasukan</a></li>
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
                <form class="form-horizontal" action="<?= base_url('pemasukan/save'); ?>" method="post">
                    <div class="card-body">
                        <!-- Hidden ID -->
                        <input type="hidden" name="id" value="<?= (empty($pemasukan) ? '' : $pemasukan['id']); ?>">

                        <!-- Tanggal -->
                        <div class="form-group row">
                            <label for="inputTanggal" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="inputTanggal" 
                                    name="tanggal" 
                                    value="<?= (empty($pemasukan) ? '' : $pemasukan['tanggal']); ?>" 
                                    required>
                            </div>
                        </div>

                        <!-- Totalisator Awal -->
                        <div class="form-group row">
                            <label for="totalisatorAwal" class="col-sm-4 col-form-label">Totalisator Awal</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="totalisatorAwal" 
                                    name="totalisator_awal" 
                                    value="<?= (empty($pemasukan) ? (empty($terakhir) ? '' : $terakhir['totalisator_akhir']) : $pemasukan['totalisator_awal']); ?>" 
                                    step="0.01" 
                                    required>
                            </div>
                        </div>

                        <!-- Totalisator Akhir -->
                        <div class="form-group row">
                            <label for="totalisatorAkhir" class="col-sm-4 col-form-label">Totalisator Akhir</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="totalisatorAkhir" 
                                    name="totalisator_akhir" 
                                    value="<?= (empty($pemasukan) ? '' : $pemasukan['totalisator_akhir']); ?>" 
                                    step="0.01" 
                                    required>
                            </div>
                        </div>

                        <!-- Harga Satuan -->
                        <div class="form-group row">
                            <label for="hargaSatuan" class="col-sm-4 col-form-label">Harga Satuan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="hargaSatuan" 
                                    name="harga_satuan" 
                                    value="<?= (empty($pemasukan) ? (empty($produk) ? '' : $produk['harga_jual']) : $pemasukan['price_unit']); ?>" 
                                    step="0.01" 
                                    required>
                            </div>
                        </div>

                        <!-- Dipping 1 dan Dipping 4 -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Dipping Terakhir / Saat Penutupan Kemarin (Cm)</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control mt-2" name="dipping1" 
                                    placeholder="Dipping Terakhir (Saat Penutupan Kemarin)" 
                                    value="<?= (empty($pemasukan) ? (empty($terakhir) ? '' : $terakhir['dipping4']) : $pemasukan['dipping1']); ?>" 
                                    step="0.01" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Dipping Saat Penutupan (Cm)</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control mt-2" name="dipping4" 
                                    placeholder="Dipping Saat Penutupan" 
                                    value="<?= (empty($pemasukan) ? '' : $pemasukan['dipping4']); ?>" 
                                    step="0.01" required>
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div class="form-group row">
                            <label for="pengiriman" class="col-sm-4 col-form-label">Pengiriman</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="pengiriman" id="pengiriman" onchange="togglePengirimanFields(this)">
                                    <option value="no" <?= (!empty($pemasukan) && $pemasukan['pengiriman'] === 'no') ? 'selected' : ''; ?>>Tidak</option>
                                    <option value="yes" <?= (!empty($pemasukan) && $pemasukan['pengiriman'] === 'yes') ? 'selected' : ''; ?>>Ada</option>
                                </select>

                                <!-- Fields for Pengiriman = Yes -->
                                <div id="pengirimanYesFields" style="display: none;">
                                    <label class="col-form-label mt-2">Waktu Pengiriman</label>
                                    <select class="form-control mt-2" name="waktu_pengiriman">
                                        <option value="Pagi" <?= (!empty($pemasukan) && $pemasukan['waktupengiriman'] === 'Pagi') ? 'selected' : ''; ?>>Pagi</option>
                                        <option value="Siang" <?= (!empty($pemasukan) && $pemasukan['waktupengiriman'] === 'Siang') ? 'selected' : ''; ?>>Siang</option>
                                        <option value="Malam" <?= (!empty($pemasukan) && $pemasukan['waktupengiriman'] === 'Malam') ? 'selected' : ''; ?>>Malam</option>
                                    </select>

                                    <label class="col-form-label mt-2">Dipping Sebelum dan Sesudah Bongkar Pengiriman (Cm)</label>
                                    <input type="number" class="form-control mt-2 dipping-input" name="dipping2" 
                                        placeholder="Dipping Sebelum Bongkar Pengiriman" 
                                        value="<?= (empty($pemasukan) ? '' : $pemasukan['dipping2']); ?>" 
                                        step="0.01">
                                    <input type="number" class="form-control mt-2 dipping-input" name="dipping3" 
                                        placeholder="Dipping Setelah Bongkar Pengiriman" 
                                        value="<?= (empty($pemasukan) ? '' : $pemasukan['dipping3']); ?>" 
                                        step="0.01">
                                </div>
                            </div>
                        </div>

                        <!-- Pumtes -->
                        <div class="form-group row">
                            <label for="pumtes" class="col-sm-4 col-form-label">Pumtes</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="pumtes" id="pumtes" onchange="togglePumtesFields(this)">
                                    <option value="no" <?= (!empty($pemasukan) && $pemasukan['pumptes'] === 'no') ? 'selected' : ''; ?>>Tidak</option>
                                    <option value="yes" <?= (!empty($pemasukan) && $pemasukan['pumptes'] === 'yes') ? 'selected' : ''; ?>>Ada</option>
                                </select>

                                <label class="col-form-label mt-2" id="besartesLabel" style="display: none;">Besartes</label>
                                <input type="number" class="form-control mt-2" id="besartesInput" name="besartes" 
                                    placeholder="Besartes" 
                                    value="<?= (empty($pemasukan) ? '' : $pemasukan['besartes']); ?>" 
                                    step="0.01" 
                                    style="display: none;">
                            </div>
                        </div>

                        <script>
                            function togglePengirimanFields(select) {
                                const pengirimanYesFields = document.getElementById('pengirimanYesFields');
                                const dippingYesInputs = document.querySelectorAll('.dipping-input');

                                if (select.value === 'yes') {
                                    pengirimanYesFields.style.display = 'block';
                                    dippingYesInputs.forEach(input => input.required = true);
                                } else {
                                    pengirimanYesFields.style.display = 'none';
                                    dippingYesInputs.forEach(input => input.required = false);
                                }
                            }

                            function togglePumtesFields(select) {
                                const besartesLabel = document.getElementById('besartesLabel');
                                const besartesInput = document.getElementById('besartesInput');
                                besartesLabel.style.display = besartesInput.style.display = (select.value === 'yes') ? 'block' : 'none';
                                besartesInput.required = (select.value === 'yes');
                            }

                            document.addEventListener('DOMContentLoaded', function() {
                                togglePengirimanFields(document.getElementById('pengiriman'));
                                togglePumtesFields(document.getElementById('pumtes'));
                            });
                        </script>

                        <div class="d-flex">
                            <button type="button" class="btn btn-default flex-fill m-3" onclick="window.history.back();">Batal</button>
                            <button type="submit" class="btn btn-primary flex-fill m-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->