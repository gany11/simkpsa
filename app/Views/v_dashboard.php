<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
            $formatrp = new \App\Libraries\CurrencyFormatter();
        ?>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 id="salesBulanIni"><?= esc(number_format($monthlyIncome['total_sales'], 2, ',', '.') ?? 0); ?> Liter</h4>
                        <p>Sales Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4 id="stokTerpakaiBulanIni"><?= esc(number_format($monthlyIncome['total_stok_terpakai'], 2, ',', '.') ?? 0); ?> Liter</h4>
                        <p>Stok Terpakai Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4 id="lossesBulanIni"><?= esc(number_format($monthlyIncome['total_losses'], 2, ',', '.') ?? 0); ?> Liter</h4>
                        <p>Losses Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4 id="pengirimanBulanIni"><?= esc(number_format($monthlyIncome['total_pengiriman'], 2, ',', '.') ?? 0); ?> Liter</h4>
                        <p>Pengiriman Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 id="pendapatanBulanIni"><?= esc($formatrp->formatRupiah($monthlyIncome['total_pendapatan']) ?? 0); ?></h4>
                        <p>Pendapatan Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4 id="pengeluaranBulanIni"><?= esc($formatrp->formatRupiah($monthlyExpense['total_pengeluaran']) ?? 0); ?></h4>
                        <p>Pengeluaran Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Keuangan Harian Bulan Ini</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyFinanceChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Keuangan Bulan Ini</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyFinanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->