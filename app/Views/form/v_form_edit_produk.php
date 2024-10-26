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
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form class="form-horizontal" action="<?= base_url('produk/edit/save'); ?>" method="post">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= (empty($produk) ? '' : $produk["id"]) ?>">

                        <div class="form-group row">
                            <label for="inputHargaBeli" class="col-sm-2 col-form-label">Harga Beli Satuan (Rupiah)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputHargaBeli" placeholder="Masukkan Harga Beli" name="hargabeli" value="<?= (empty($produk) ? '' : number_format($produk["harga_beli"], 0, ',', '.')) ?>" oninput="formatRupiah(this)" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputHargaJual" class="col-sm-2 col-form-label">Harga Jual Satuan (Rupiah)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputHargaJual" placeholder="Masukkan Harga Jual" name="hargajual" value="<?= (empty($produk) ? '' : number_format($produk["harga_jual"], 0, ',', '.')) ?>" oninput="formatRupiah(this)" required>
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

    <script>
        function formatRupiah(input) {
            // Menghapus karakter non-angka, tetapi membiarkan satu titik dan satu koma
            let value = input.value.replace(/[^0-9.,]/g, '');

            // Memisahkan bagian integer dan desimal
            let parts = value.split(',');
            let integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format ribuan
            let decimalPart = parts[1] ? ',' + parts[1].slice(0, 2) : ''; // Maksimal 2 digit desimal

            // Gabungkan kembali bagian integer dan desimal
            input.value = integerPart + decimalPart;
        }

        // Validasi karakter yang diizinkan saat mengetik
        function isNumberKey(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            return charCode === 8 || charCode === 0 || (charCode >= 48 && charCode <= 57);
        }
    </script>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->