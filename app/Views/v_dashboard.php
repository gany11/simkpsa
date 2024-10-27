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
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 id="salesBulanIni"></h4>


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
                        <h4 id="stokTerpakaiBulanIni"></h4>

                        
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
                        <h4 id="lossesBulanIni"></h4>
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
                        <h4 id="pengirimanBulanIni"></h4>
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
                        <h4 id="pendapatanBulanIni"></h4>
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
                        <h4 id="pengeluaranBulanIni"></h4>
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
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Keuangan Harian Bulan Ini</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Canvas untuk Chart Keuangan Harian Bulan Ini -->
                        <canvas id="dailyFinanceChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Keuangan Bulanan Tahun Ini</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Canvas untuk Chart Keuangan Bulanan Tahun Ini -->
                        <canvas id="monthlyFinanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pemasukan = <?= json_encode($pemasukan); ?>;
            const pengeluaran = <?= json_encode($pengeluaran); ?>;

            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear();

            let salesTotal = 0;
            let stokTerpakaiTotal = 0;
            let lossesTotal = 0;
            let pengirimanTotal = 0;
            let pendapatanTotal = 0;
            let pengeluaranTotal = 0;

            // Hitung total untuk tiap kategori di pendapatan (pemasukan)
            pemasukan.forEach(item => {
                const date = new Date(item.tanggal);
                if (date.getMonth() + 1 === currentMonth && date.getFullYear() === currentYear) {
                    salesTotal += parseFloat(item.sales || 0);
                    stokTerpakaiTotal += parseFloat(item.stok_terpakai || 0);
                    lossesTotal += parseFloat(item.losses || 0);
                    pengirimanTotal += parseFloat(item.besar_pengiriman || 0);
                    pendapatanTotal += parseFloat(item.total || 0);
                }
            });

            // Hitung total untuk pengeluaran
            pengeluaran.forEach(item => {
                const date = new Date(item.date);
                if (date.getMonth() + 1 === currentMonth && date.getFullYear() === currentYear) {
                    pengeluaranTotal += parseFloat(item.nominal || 0);
                }
            });

            // Menampilkan hasil ke elemen <span> pada dashboard
            document.getElementById("salesBulanIni").textContent = `${salesTotal.toLocaleString("id-ID", { minimumFractionDigits: 2 })} Liter`;
            document.getElementById("stokTerpakaiBulanIni").textContent = `${stokTerpakaiTotal.toLocaleString("id-ID", { minimumFractionDigits: 2 })} Liter`;
            document.getElementById("lossesBulanIni").textContent = `${lossesTotal.toLocaleString("id-ID", { minimumFractionDigits: 2 })} Liter`;
            document.getElementById("pengirimanBulanIni").textContent = `${pengirimanTotal.toLocaleString("id-ID", { minimumFractionDigits: 2 })} Liter`;

            const formatRupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 2
                }).format(number);
            };

            document.getElementById("pendapatanBulanIni").textContent = formatRupiah(pendapatanTotal);
            document.getElementById("pengeluaranBulanIni").textContent = formatRupiah(pengeluaranTotal);

            // Helper untuk menghitung total harian dengan pengecekan tanggal valid
            const getDailyData = (data, field, dateField = 'tanggal') => {
                const dailyData = {};
                data.forEach(item => {
                    const date = new Date(item[dateField]);
                    if (!isNaN(date.getTime())) {
                        const formattedDate = date.toISOString().split('T')[0];
                        dailyData[formattedDate] = (dailyData[formattedDate] || 0) + parseFloat(item[field] || 0);
                    } else {
                        console.warn("Tanggal tidak valid:", item[dateField]);
                    }
                });
                return Object.keys(dailyData).map(key => ({ date: key, total: dailyData[key] }));
            };

            // Helper untuk menghitung total bulanan
            const getMonthlyData = (data, field, dateField = 'tanggal') => {
                const monthlyData = Array(12).fill(0);
                data.forEach(item => {
                    const date = new Date(item[dateField]);
                    if (!isNaN(date.getTime())) {
                        const month = date.getMonth();
                        monthlyData[month] += parseFloat(item[field] || 0);
                    }
                });
                return monthlyData;
            };

            // Data untuk grafik harian
            const dailyIncomeData = getDailyData(pemasukan, "total", "tanggal");
            const dailyExpenseData = getDailyData(pengeluaran, "nominal", "date")

            const dailyLabels = dailyIncomeData.map(item => item.date);
            const dailyIncomeTotals = dailyIncomeData.map(item => item.total);
            const dailyExpenseTotals = dailyExpenseData.map(item => item.total);

            // Data untuk grafik bulanan
            const monthlyIncomeTotals = getMonthlyData(pemasukan, "total", "tanggal");
            const monthlyExpenseTotals = getMonthlyData(pengeluaran, "nominal", "date");
            const monthlyLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

            // Konfigurasi Chart Harian
            const dailyFinanceChart = new Chart(
                document.getElementById('dailyFinanceChart'),
                {
                    type: 'line',
                    data: {
                        labels: dailyLabels,
                        datasets: [
                            {
                                label: "Pendapatan Harian",
                                data: dailyIncomeTotals,
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                fill: false
                            },
                            {
                                label: "Pengeluaran Harian",
                                data: dailyExpenseTotals,
                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                borderColor: "rgba(255, 99, 132, 1)",
                                fill: false
                            }
                        ]
                    },
                }
            );

            // Konfigurasi Chart Bulanan
            const monthlyFinanceChart = new Chart(
                document.getElementById('monthlyFinanceChart'),
                {
                    type: 'bar',
                    data: {
                        labels: monthlyLabels,
                        datasets: [
                            {
                                label: "Pendapatan Bulanan",
                                data: monthlyIncomeTotals,
                                backgroundColor: "rgba(153, 102, 255, 0.2)",
                                borderColor: "rgba(153, 102, 255, 1)"
                            },
                            {
                                label: "Pengeluaran Bulanan",
                                data: monthlyExpenseTotals,
                                backgroundColor: "rgba(255, 159, 64, 0.2)",
                                borderColor: "rgba(255, 159, 64, 1)"
                            }
                        ]
                    },
                }
            );
        });
    </script>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->