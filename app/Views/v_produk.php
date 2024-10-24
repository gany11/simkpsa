<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img 
                src="<?php echo base_url('assets/images/produk.png');?>" 
                alt="PT Perta Sakti Abadi" 
                style="width: 20%; height: auto;">
          </div>


          <ul class="list-group list-group-unbordered m-3 mt-5 mb-3">
            <li class="list-group-item d-flex justify-content-between">
                <b>Harga Jual Satuan</b> <span><?= $lastProduct['harga_jual']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <b>Harga Beli Satuan</b> <span><?= $lastProduct['harga_beli']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <b>Stok Terbaru (Update: 20 Oktober 2024)</b> <span>xxx Liter</span>
            </li>
          </ul>




          <div class="d-flex">
            <a href="<?php echo base_url('produk/edit')?>" class="btn btn-primary flex-fill m-3"><b>Edit Produk</b></a>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->