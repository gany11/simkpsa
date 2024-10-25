<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengeluaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Pengeluaran</li>
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
                    <a href="<?= base_url('pengeluaran/tambah') ?>" class="btn btn-primary">Tambah Data Pengeluaran</a>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $formatRupiah = new \App\Libraries\CurrencyFormatter();
                                $no = 1;
                                foreach ($pengeluaran as $item) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= esc($item['date']); ?></td> <!-- Menampilkan tanggal -->
                                        <td><?= esc($item['desc']); ?></td>
                                        <td><?= esc($formatRupiah->formatRupiah($item['nominal'])); ?></td>
                                        <td>
                                            <a href="<?= base_url('pengeluaran/edit/' . $item['id']) ?>" class="btn btn-success" title="Edit"><i class="fas fa-pen-alt"></i></a>
                                            <a href="<?= base_url('pengeluaran/delete/' . $item['id']) ?>" class="btn btn-danger delete-link" title="Hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
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