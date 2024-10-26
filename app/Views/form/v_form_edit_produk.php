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
                                <input type="number" class="form-control" id="inputHargaBeli" 
                                    placeholder="Masukkan Harga Beli" 
                                    name="hargabeli" 
                                    value="<?= (empty($produk) ? '' : $produk["harga_beli"]) ?>" 
                                    step="0.01" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputHargaJual" class="col-sm-2 col-form-label">Harga Jual Satuan (Rupiah)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputHargaJual" 
                                    placeholder="Masukkan Harga Jual" 
                                    name="hargajual" 
                                    value="<?= (empty($produk) ? '' : $produk["harga_jual"]) ?>" 
                                    step="0.01" 
                                    required>
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


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->