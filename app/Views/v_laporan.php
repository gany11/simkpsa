<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <form class="form-horizontal" action="<?= base_url('laporan'); ?>" method="post">
              <div class="card-body">
                  <?php if (empty($tanggal)): ?>
                      <div class="alert alert-warning" role="alert">
                          Laporan tidak tersedia.
                      </div>
                  <?php else: ?>
                      <div class="form-group row">
                          <label for="inputLaporan" class="col-sm-4 col-form-label">Pilih Jenis Laporan</label>
                          <div class="col-sm-8">
                              <select id="inputLaporan" class="form-control" name="jenis_laporan" required>
                                  <option value="tahunan" <?= !empty($jenis) && $jenis == "Tahunan" ? 'selected' : ''; ?>>Laporan Tahunan</option>
                                  <option value="bulanan" <?= !empty($jenis) && $jenis == "Bulanan" ? 'selected' : ''; ?>>Laporan Bulanan</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="inputTahun" class="col-sm-4 col-form-label">Tahun</label>
                          <div class="col-sm-8">
                              <select id="inputTahun" class="form-control" name="tahun" required>
                                  <?php
                                  // Mendapatkan tahun unik dari tanggal
                                  $tahun_unik = array_map(function($item) {
                                      return date('Y', strtotime($item['unique_date']));
                                  }, $tanggal);
                                  $tahun_unik = array_unique($tahun_unik);
                                  sort($tahun_unik); // Mengurutkan tahun

                                  foreach ($tahun_unik as $tahun): ?>
                                      <option value="<?= $tahun; ?>" <?= !empty($tahun) && $tahun == $tahun ? 'selected' : ''; ?>><?= $tahun; ?></option>
                                  <?php endforeach; ?>
                              </select>
                              <div class="form-group row" id="bulanDiv" style="display: <?= !empty($jenis) && $jenis == "Bulanan" ? 'block' : 'none'; ?>;">
                                  <label for="inputBulan" class="col-sm-12 col-form-label">Bulan</label>
                                  <div class="col-sm-12">
                                      <select id="inputBulan" class="form-control" name="bulan">
                                          <option value="">Pilih Bulan</option>
                                          <!-- Bulan akan diisi lewat JavaScript -->
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>

                  <?php endif; ?>
              </div>
              <!-- /.card-body -->

              <div class="d-flex">
                  <button type="submit" class="btn btn-primary flex-fill m-3">Tampilkan Laporan</button>
              </div>
              <!-- /.card-footer -->
          </form>

          <script>
              const tanggalData = <?= json_encode($tanggal); ?>; // Menyimpan data tanggal ke JavaScript
              const selectedBulan = <?= json_encode($bulan); ?>; // Menyimpan bulan terpilih
              const selectedTahun = <?= json_encode($tahun); ?>; // Menyimpan tahun terpilih

              document.getElementById('inputLaporan').addEventListener('change', function() {
                  var bulanDiv = document.getElementById('bulanDiv');
                  var tahunSelect = document.getElementById('inputTahun');
                  var bulanSelect = document.getElementById('inputBulan');

                  // Reset bulan dropdown
                  bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';
                  bulanSelect.required = false; // Set bulan not required initially

                  // Sembunyikan bulanDiv jika jenis laporan adalah tahunan
                  if (this.value === 'bulanan') {
                      bulanDiv.style.display = 'block';
                      bulanSelect.required = true; // Set bulan required if 'bulanan' is selected
                      // Pastikan tahun sudah dipilih sebelum menunjukkan bulan
                      if (tahunSelect.value) {
                          updateBulan(tahunSelect.value);
                      }
                  } else {
                      bulanDiv.style.display = 'none'; // Hide bulanDiv if 'tahunan' is selected
                      bulanSelect.required = false; // Set bulan not required if 'tahunan' is selected
                  }
              });

              document.getElementById('inputTahun').addEventListener('change', function() {
                  const tahunDipilih = this.value;

                  // Cek jenis laporan untuk menampilkan bulan jika perlu
                  const jenisLaporan = document.getElementById('inputLaporan').value;
                  if (jenisLaporan === 'bulanan') {
                      updateBulan(tahunDipilih);
                  }
              });

              function updateBulan(tahunDipilih) {
                  const bulanSelect = document.getElementById('inputBulan');
                  // Reset bulan dropdown
                  bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';

                  const bulanTersedia = new Set(); // Menggunakan Set untuk menghindari duplikasi
                  tanggalData.forEach(item => {
                      const date = new Date(item.unique_date);
                      if (date.getFullYear() == tahunDipilih) {
                          bulanTersedia.add(date.getMonth() + 1); // Menyimpan bulan (1-12)
                      }
                  });

                  // Mengisi dropdown bulan
                  bulanTersedia.forEach(bulan => {
                      bulanSelect.innerHTML += `<option value="${bulan}" ${bulan == selectedBulan ? 'selected' : ''}>${new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(new Date(2020, bulan - 1))}</option>`;
                  });

                  // Tampilkan bulanDiv hanya jika ada bulan yang tersedia
                  const bulanDiv = document.getElementById('bulanDiv');
                  bulanDiv.style.display = (bulanTersedia.size > 0) ? 'block' : 'none';
              }

              // Initialize the bulan dropdown if the selected tahun and bulan are set
              if (selectedTahun) {
                  document.getElementById('inputTahun').value = selectedTahun;
                  updateBulan(selectedTahun); // Populate bulan dropdown
              }

              // Call the change event to set the initial visibility of bulanDiv
              document.getElementById('inputLaporan').dispatchEvent(new Event('change'));
          </script>
        </div>
      </div>
      <?php
        $formatTanggal = new \App\Libraries\DateConverter();
        $formatrp = new \App\Libraries\CurrencyFormatter();
        
        date_default_timezone_set("Asia/Jakarta");
      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php if (empty($laporan['data'])): ?>
                <!-- Bagian 1: Ketika laporan tidak ada -->
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Isi Format Laporan Terlebih Dahulu Untuk Melihat Laporan!</h5>
                </div>
            <?php else: ?>
                <!-- Bagian 2: Ketika laporan ada -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                PT Perta Sakti Abadi
                                <small class="float-right">Data: <?= esc($formatTanggal->formatTanggalBulanText(date("Y-m-d"))); ?> <?= esc(date("H:i:s")); ?></small>
                            </h4>
                        </div>
                    </div>
                    
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            Alamat
                            <address>
                                <strong>Pertashop 3P.45301</strong><br>
                                Ds. Tarikolot<br>
                                Kec. Jatinunggal<br>
                                Kab. Sumedang<br>
                                Jam Operasional 06:00 sd 18:00 Wib
                            </address>
                        </div>
                        
                        <div class="col-sm-6 invoice-col">
                            Laporan Keuangan
                            <address>
                                <strong>Jenis: <?= esc($jenis); ?></strong><br>
                                Tahun: <?= esc($tahun); ?><br>
                                <?= (($jenis == "Bulanan")? 'Bulan: ' . esc($formatTanggal->getBulanNama($bulan)) : ''); ?>
                            </address>
                        </div>
                    </div>

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($laporan['data'] as $index => $item): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($item['date']); ?></td>
                                            <td><?= esc($item['keterangan']); ?></td>
                                            <td><?= esc($formatrp->formatRupiah($item['pemasukan'])); ?></td>
                                            <td><?= esc($formatrp->formatRupiah($item['pengeluaran'])); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Summary Row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Total Sales:</th>
                                        <td><?= esc(number_format($laporan['total_sales'], 2, ',', '.')); ?> Liter</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pendapatan:</th>
                                        <td>Rp <?= esc(number_format($laporan['total_pendapatan'], 2, ',', '.')); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Pengeluaran:</th>
                                        <td>Rp <?= esc(number_format($laporan['total_pengeluaran'], 2, ',', '.')); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Stok Terpakai:</th>
                                        <td><?= esc(number_format($laporan['total_stok_terpakai'], 2, ',', '.')); ?> Liter</td>
                                    </tr>
                                    <tr>
                                        <th>Total Losses:</th>
                                        <td><?= esc(number_format($laporan['total_losess'], 2, ',', '.')); ?> Liter</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pumptes:</th>
                                        <td><?= esc(number_format($laporan['total_tes'], 2, ',', '.')); ?> Liter (<?= esc(number_format($laporan['jumlah_pumptes'])); ?> Pumptes)</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pengiriman:</th>
                                        <td><?= esc(number_format($laporan['total_pengiriman'], 2, ',', '.')); ?> Liter (<?= esc(number_format($laporan['jumlah_pengiriman'])); ?> Pengiriman)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->