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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('pemasukan/save'); ?>" method="post">
                                <table class="table">
                                <tbody>
    <tr>
        <td>Tanggal</td>
        <td>
            <div class="input-group">
                <input type="hidden" class="form-control" name="id" <?= (empty($pemasukan) ? '' : 'value="'.$pemasukan['id'].'"') ?>>
                <input type="date" class="form-control" name="tanggal" <?= (empty($pemasukan) ? '' : 'value="'.$pemasukan['tanggal'].'"') ?> required>
            </div>
        </td>
    </tr>
    <tr>
        <td>Totalisator Awal</td>
        <td>
            <div class="input-group">
                <input type="text" class="form-control" name="totalisator_awal" placeholder="Masukkan Totalisator Awal" 
                <?= (empty($pemasukan) ? (isset($terakhir) ? 'value="'.esc($terakhir['totalisator_akhir']).'"' : '') : 'value="'.esc($pemasukan['totalisator_awal']).'"') ?> oninput="formatRupiah(this)" required>
            </div>
        </td>
    </tr>
    <tr>
        <td>Totalisator Akhir</td>
        <td>
            <div class="input-group">
                <input type="text" class="form-control" name="totalisator_akhir" placeholder="Masukkan Totalisator Akhir" <?= (empty($pemasukan) ? '' : 'value="'.esc($pemasukan['totalisator_akhir']).'"') ?> oninput="formatRupiah(this)" required>
            </div>
        </td>
    </tr>
    <tr>
        <td>Harga Satuan</td>
        <td>
            <div class="input-group">
                <input type="text" class="form-control" name="price_unit" placeholder="Masukkan Harga Satuan" <?= (empty($pemasukan) ? 'value="'.esc($produk['harga_jual']).'"' : 'value="'.esc($pemasukan['price_unit']).'"') ?> oninput="formatRupiah(this)" required>
            </div>
        </td>
    </tr>
    <tr>
        <td>Pengiriman</td>
        <td>
            <div class="input-group">
                <label><input type="radio" name="pengiriman" value="yes" onchange="togglePengirimanOptions(this)"> Ya</label>
                <label><input type="radio" name="pengiriman" value="no" onchange="togglePengirimanOptions(this)"> Tidak</label>
                <div id="pengirimanOptions" style="display: none;">
                    <div>
                        <label><input type="radio" name="waktu_pengiriman" value="Pagi" onchange="toggleDippingInputs(this)"> Pagi</label>
                    </div>
                    <div>
                        <label><input type="radio" name="waktu_pengiriman" value="Siang" onchange="toggleDippingInputs(this)"> Siang</label>
                    </div>
                    <div>
                        <label><input type="radio" name="waktu_pengiriman" value="Malam" onchange="toggleDippingInputs(this)"> Malam</label>
                    </div>
                    <div id="dippingInputs" style="display: none;"></div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>Pumptes</td>
        <td>
            <div class="input-group">
                <label><input type="radio" name="pumptes" value="yes" onchange="togglePumptesInput(this)"> Ya</label>
                <label><input type="radio" name="pumptes" value="no" onchange="togglePumptesInput(this)"> Tidak</label>
                <input type="text" class="form-control" id="besartesInput" name="besartes" placeholder="Masukkan Besar Tes" style="display: none;" oninput="formatRupiah(this)">
            </div>
        </td>
    </tr>
</tbody>

<script>
function formatRupiah(input) {
    // Menghapus karakter non-angka
    let value = input.value.replace(/[^0-9]/g, '');
    // Format ke dalam format ribuan
    if (value.length > 0) {
        value = Number(value).toLocaleString('id-ID');
    }
    // Update nilai input
    input.value = value;
}

function togglePengirimanOptions(radio) {
    const pengirimanOptions = document.getElementById('pengirimanOptions');
    pengirimanOptions.style.display = radio.value === 'yes' ? 'block' : 'none';
}

function toggleDippingInputs(radio) {
    const dippingInputsContainer = document.getElementById('dippingInputs');
    dippingInputsContainer.innerHTML = ''; // Reset input container

    if (radio.value === 'Pagi') {
        dippingInputsContainer.innerHTML = `
            <input type="text" class="form-control" name="dipping1" placeholder="Dipping (Sebelum Pengiriman)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping2" placeholder="Dipping (Setelah Pengiriman)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping3" placeholder="Dipping (Saat Tutup)" oninput="formatRupiah(this)">
        `;
    } else if (radio.value === 'Siang') {
        dippingInputsContainer.innerHTML = `
            <input type="text" class="form-control" name="dipping1" placeholder="Dipping (Saat Buka)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping2" placeholder="Dipping (Sebelum Pengiriman)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping3" placeholder="Dipping (Setelah Pengiriman)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping4" placeholder="Dipping (Saat Tutup)" oninput="formatRupiah(this)">
        `;
    } else if (radio.value === 'Malam') {
        dippingInputsContainer.innerHTML = `
            <input type="text" class="form-control" name="dipping1" placeholder="Dipping (Saat Buka)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping2" placeholder="Dipping (Saat Tutup)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping3" placeholder="Dipping (Sebelum Pengiriman)" oninput="formatRupiah(this)">
            <input type="text" class="form-control" name="dipping4" placeholder="Dipping (Setelah Pengiriman)" oninput="formatRupiah(this)">
        `;
    }
    dippingInputsContainer.style.display = dippingInputsContainer.innerHTML ? 'block' : 'none';
}

function togglePumptesInput(radio) {
    const besartesInput = document.getElementById('besartesInput');
    besartesInput.style.display = radio.value === 'yes' ? 'block' : 'none';
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