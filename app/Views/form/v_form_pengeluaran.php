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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('pengeluaran/save'); ?>" method="post">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" name="id" <?= (empty($pengeluaran) ? '' : 'value="'.$pengeluaran['id'].'"') ?>>
                                                    <input type="date" class="form-control" name="date" <?= (empty($pengeluaran) ? '' : 'value="'.$pengeluaran['date'].'"') ?> required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Deskripsi</td>
                                            <td>
                                                <div class="input-group">
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

                                                <!-- Tambahkan script validasi pada form -->
                                                <script>
                                                function toggleOtherInput(select) {
                                                    const otherDescInput = document.getElementById('otherDescInput');
                                                    otherDescInput.style.display = (select.value === 'Lainnya') ? 'block' : 'none';
                                                }

                                                document.querySelector('form').addEventListener('submit', function(event) {
                                                    const descSelect = document.getElementById('descSelect');
                                                    if (descSelect.value === '') {
                                                        event.preventDefault(); // Mencegah pengiriman form
                                                        Swal.fire({
                                                            title: 'Peringatan!',
                                                            text: 'Silakan pilih deskripsi sebelum mengirimkan form.',
                                                            icon: 'warning',
                                                            confirmButtonText: 'OK'
                                                        }); // Tampilkan SweetAlert
                                                    }
                                                });
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nominal (Rupiah)</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Masukkan Nominal" name="nominal" <?= (empty($pengeluaran) ? '' : 'value="'.number_format($pengeluaran['nominal'], 0, ',', '.').'"') ?> oninput="formatRupiah(this)" required>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <script>
                                function formatRupiah(input) {
                                    // Menghapus karakter non-angka
                                    let value = input.value.replace(/[^0-9]/g, '');
                                    // Format ke dalam format ribuan
                                    value = Number(value).toLocaleString('id-ID');
                                    // Update nilai input
                                    input.value = value;
                                }

                                function toggleOtherInput(select) {
                                    const otherInput = document.getElementById('otherDescInput');
                                    if (select.value === 'Lainnya') {
                                        otherInput.style.display = 'block';
                                        otherInput.required = true;
                                    } else {
                                        otherInput.style.display = 'none';
                                        otherInput.value = '';
                                        otherInput.required = false;
                                    }
                                }
                                </script>

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