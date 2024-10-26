<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pemasukan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Pemasukan</li>
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
                    <a href="<?= base_url('pemasukan/tambah') ?>" class="btn btn-primary">Tambah Data Pemasukan</a>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Hari</th>
                                  <th>Sales</th>
                                  <th>Harga Satuan</th>
                                  <th>Rupiah</th>
                                  <th>Stok Terpakai</th>
                                  <th>Losess</th>
                                  <th>Total Tes</th>
                                  <th>Total Pengiriman</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $formatRupiah = new \App\Libraries\CurrencyFormatter();
                                $formatTanggal = new \App\Libraries\DateConverter();
                                $formatribuan = new \App\Libraries\FormatNumber();
                                $no = 1;

                                foreach ($pemasukan as $item) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= esc($formatTanggal->formatTanggalBulanText($item['tanggal'])); ?></td> <!-- Menampilkan tanggal -->
                                        <td><?= esc($formatribuan->format($item['sales'])); ?> Liter</td> <!-- Menampilkan sales -->
                                        <td><?= esc($formatRupiah->formatRupiah($item['price_unit'])); ?></td> <!-- Menampilkan harga satuan -->
                                        <td><?= esc($formatRupiah->formatRupiah($item['total'])); ?></td> <!-- Menampilkan total -->
                                        <td><?= esc($formatribuan->format($item['stok_terpakai'])); ?> Liter</td> <!-- Menampilkan stok terpakai -->
                                        <td class="<?= $item['losses'] >= 0 ? 'text-success' : 'text-danger'; ?>"><?= $item['losses'] >= 0 ? '+' : ''; ?><?= esc($formatribuan->format($item['losses'])); ?> Liter</td>
                                        <td><?= esc($formatribuan->format(empty($item['besartes']) ? '-' : $item['besartes'])); ?> Liter</td> <!-- Menampilkan total tes -->
                                        <td><?= esc($formatribuan->format(empty($item['besar_pengiriman']) ? '-' : $item['besar_pengiriman'])); ?> Liter</td> <!-- Menampilkan total pengiriman -->
                                        <td>
                                            <?php if ($no == 1) { // Cek apakah ini adalah data terbaru ?>
                                                <a href="<?= base_url('pemasukan/edit/' . $item['id']) ?>" class="btn btn-success m-1" title="Edit"><i class="fas fa-pen-alt"></i></a>
                                                <a href="<?= base_url('pemasukan/delete/' . $item['id']) ?>" class="btn btn-danger delete-link m-1" title="Hapus"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php 
                                    $no++;
                                } 
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>No</th>
                                  <th>Hari</th>
                                  <th>Sales</th>
                                  <th>Harga Satuan</th>
                                  <th>Rupiah</th>
                                  <th>Stok Terpakai</th>
                                  <th>Losess</th>
                                  <th>Total Tes</th>
                                  <th>Total Pengiriman</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->