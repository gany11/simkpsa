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
                <form class="form-horizontal" action="<?= base_url('pemasukan/save'); ?>" method="post" onsubmit="return validateForm()">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= (empty($pemasukan) ? '' : $pemasukan['id']); ?>">

                        <div class="form-group row">
                            <label for="inputTanggal" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="inputTanggal" 
                                    name="tanggal" 
                                    value="<?= (empty($pemasukan) ? '' : $pemasukan['tanggal']); ?>" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTotalisatorAwal" class="col-sm-4 col-form-label">Totalisator Awal</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputTotalisatorAwal" 
                                    name="totalisator_awal" 
                                    placeholder="Masukkan Totalisator Awal" 
                                    value="<?= (empty($pemasukan) ? (isset($terakhir) ? esc($terakhir['totalisator_akhir']) : '') : esc($pemasukan['totalisator_awal'])); ?>" 
                                    step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTotalisatorAkhir" class="col-sm-4 col-form-label">Totalisator Akhir</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputTotalisatorAkhir" 
                                    name="totalisator_akhir" 
                                    placeholder="Masukkan Totalisator Akhir" 
                                    value="<?= (empty($pemasukan) ? '' : esc($pemasukan['totalisator_akhir'])); ?>" 
                                    step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPriceUnit" class="col-sm-4 col-form-label">Harga Satuan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputPriceUnit" 
                                    name="price_unit" 
                                    placeholder="Masukkan Harga Satuan" 
                                    value="<?= (empty($pemasukan) ? esc($produk['harga_jual']) : esc($pemasukan['price_unit'])); ?>" 
                                    step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPengiriman" class="col-sm-4 col-form-label">Pengiriman</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="inputPengiriman" name="pengiriman" onchange="togglePengirimanOptions(this)">
                                    <option value="yes">Ya</option>
                                    <option value="no" selected>Tidak</option>
                                </select>
                            </div>
                        </div>

                        <div id="pengirimanOptions" style="display: none;">
                            <div class="form-group row">
                                <label for="inputWaktuPengiriman" class="col-sm-4 col-form-label">Waktu Pengiriman</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="inputWaktuPengiriman" name="waktu_pengiriman">
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang" selected>Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDipping1" class="col-sm-4 col-form-label">Dipping 1</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping1" 
                                        name="dipping1" 
                                        placeholder="Hasil Diping Terakhir" step="0.01" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDipping2" class="col-sm-4 col-form-label">Dipping 2</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping2" 
                                        name="dipping2" 
                                        placeholder="Sebelum Pembongkaran Kiriman" step="0.01">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDipping3" class="col-sm-4 col-form-label">Dipping 3</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping3" 
                                        name="dipping3" 
                                        placeholder="Setelah Pembongkaran Kiriman" step="0.01">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDipping4" class="col-sm-4 col-form-label">Dipping 4</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping4" 
                                        name="dipping4" 
                                        placeholder="Saat Penutupan" step="0.01">
                                </div>
                            </div>
                        </div>

                        <div id="dippingOptions" style="display: block;">
                            <div class="form-group row">
                                <label for="inputDipping1" class="col-sm-4 col-form-label">Dipping 1</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping1" 
                                        name="dipping1" 
                                        placeholder="Hasil Diping Terakhir" step="0.01" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDipping4" class="col-sm-4 col-form-label">Dipping 4</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputDipping4" 
                                        name="dipping4" 
                                        placeholder="Saat Penutupan" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPumptes" class="col-sm-4 col-form-label">Pumptes</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="inputPumptes" name="pumptes" onchange="togglePumptesInput(this)">
                                    <option value="no" selected>Tidak</option>
                                    <option value="yes">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div id="besartesInputContainer" style="display: none;">
                            <div class="form-group row">
                                <label for="besartesInput" class="col-sm-4 col-form-label">Besar Tes</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="besartesInput" 
                                        name="besartes" 
                                        placeholder="Masukkan Besar Tes" step="0.01">
                                </div>
                            </div>
                        </div>

                        <script>
                            function togglePengirimanOptions(select) {
                                const pengirimanOptions = document.getElementById('pengirimanOptions');
                                const dippingOptions = document.getElementById('dippingOptions');
                                if (select.value === 'yes') {
                                    pengirimanOptions.style.display = 'block';
                                    dippingOptions.style.display = 'none';
                                } else {
                                    pengirimanOptions.style.display = 'none';
                                    dippingOptions.style.display = 'block';
                                }
                            }

                            function togglePumptesInput(select) {
                                const besartesInputContainer = document.getElementById('besartesInputContainer');
                                besartesInputContainer.style.display = select.value === 'yes' ? 'block' : 'none';
                            }

                            function validateForm() {
                                const pengirimanSelect = document.getElementById('inputPengiriman');
                                const pumptesSelect = document.getElementById('inputPumptes');
                                const dipping1 = document.getElementById('inputDipping1');
                                const dipping2 = document.getElementById('inputDipping2');
                                const dipping3 = document.getElementById('inputDipping3');
                                const dipping4 = document.getElementById('inputDipping4');
                                const besartesInput = document.getElementById('besartesInput');

                                let valid = true;

                                if (pengirimanSelect.value === 'yes') {
                                    if (!dipping1.value || !dipping2.value || !dipping3.value || !dipping4.value) {
                                        sweetAlert('Oops!', 'Lengkapi Hasil Dipping!', 'error');
                                        valid = false;
                                    }
                                }

                                if (pumptesSelect.value === 'yes' && !besartesInput.value) {
                                    sweetAlert('Oops!', 'Lengkapi Besar Tes!', 'error');
                                    valid = false;
                                }

                                return valid;
                            }
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