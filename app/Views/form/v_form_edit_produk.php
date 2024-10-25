<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('produk')?>">Produk</a></li>
                <li class="breadcrumb-item active">Edit Produk</li>
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
                            <form action="<?= base_url('produk/edit/save'); ?>" method="post">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Harga Beli Satuan (Rupiah)</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" name="id" value="<?= (empty($produk) ? '' : $produk["id"]) ?>">
                                                    <input type="text" class="form-control" placeholder="Masukkan Harga Beli" name="hargabeli" value="<?= (empty($produk) ? '' : number_format($produk["harga_beli"], 0, ',', '.')) ?>" oninput="formatRupiah(this)" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Jual Satuan (Rupiah)</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Masukkan Harga Jual" name="hargajual" value="<?= (empty($produk) ? '' : number_format($produk["harga_jual"], 0, ',', '.')) ?>" oninput="formatRupiah(this)" required>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <script>
                                    function formatRupiah(input) {
                                        // Menghapus karakter non-angka
                                        let value = input.value.replace(/[^0-9]/g, '');
                                        // Format ke dalam format ribuan
                                        value = Number(value).toLocaleString('id-ID');
                                        // Update nilai input
                                        input.value = value;
                                    }

                                    // Validasi karakter yang diizinkan saat mengetik
                                    function isNumberKey(evt) {
                                        const charCode = (evt.which) ? evt.which : evt.keyCode;
                                        return charCode === 8 || charCode === 0 || (charCode >= 48 && charCode <= 57);
                                    }
                                    </script>
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