<?php

namespace App\Controllers;
use App\Models\Produk_model;
use App\Models\Pengguna_model;
use App\Models\Income_model;
use App\Models\Expense_model;
use App\Models\Report_model;
use App\Libraries\CurrencyFormatter;
    
class Admin extends BaseController
{
    public function index()
    {
        $incomeModel = new Income_model();
        $expenseModel = new Expense_model();

        $year = date('Y');
        $month = date('m');

        $monthlyIncome = $incomeModel->getMonthlyTotals($year, $month) ?? [
            'total_sales' => 0,
            'total_stok_terpakai' => 0,
            'total_pendapatan' => 0,
            'total_losses' => 0,
            'total_pengiriman' => 0,
        ];

        $monthlyExpense = $expenseModel->getMonthlyExpenses($year, $month) ?? [
            'total_pengeluaran' => 0,
        ];

        $dailyIncome = $incomeModel->getDailyIncome($year, $month);
        $dailyExpense = $expenseModel->getDailyExpense($year, $month);

        $dailyData = [];

        foreach ($dailyIncome as $income) {
            $date = date('j', strtotime($income['tanggal']));
            $dailyData[$date] = [
                'income' => (float)$income['total'],
                'expense' => 0
            ];
        }

        foreach ($dailyExpense as $expense) {
            $date = date('j', strtotime($expense['date']));
            if (!isset($dailyData[$date])) {
                $dailyData[$date] = ['income' => 0, 'expense' => 0];
            }
            $dailyData[$date]['expense'] += (float)$expense['nominal'];
        }

        $filteredData = array_filter($dailyData, function($data) {
            return $data['income'] > 0 || $data['expense'] > 0;
        });

        ksort($filteredData);

        $dailyLabels = array_keys($filteredData);
        $dailyIncomeData = array_column($filteredData, 'income');
        $dailyExpenseData = array_column($filteredData, 'expense');

        $monthlyIncome2 = $incomeModel->getMonthlyIncome($year);
        $monthlyExpense2 = $expenseModel->getMonthlyExpense($year);

        $monthlyData = [];

        foreach ($monthlyIncome2 as $income) {
            $month = (int)$income['month'];
            $monthlyData[$month] = [
                'income' => (float)$income['total'],
                'expense' => 0
            ];
        }

        foreach ($monthlyExpense2 as $expense) {
            $month = (int)$expense['month'];
            if (!isset($monthlyData[$month])) {
                $monthlyData[$month] = ['income' => 0, 'expense' => 0];
            }
            $monthlyData[$month]['expense'] += (float)$expense['total'];
        }

        ksort($monthlyData);

        $monthlyLabels = array_map(function ($month) {
            return date("F", mktime(0, 0, 0, $month, 1));
        }, array_keys($monthlyData));
        
        $monthlyIncomeData = array_column($monthlyData, 'income');
        $monthlyExpenseData = array_column($monthlyData, 'expense');

        $data = [
            'title' => 'Dashboard',
            'page' => 'dashboard',
            'monthlyIncome' => $monthlyIncome,
            'monthlyExpense' => $monthlyExpense,
            'dailyLabels' => $dailyLabels,
            'dailyIncomeData' => $dailyIncomeData,
            'dailyExpenseData' => $dailyExpenseData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyIncomeData' => $monthlyIncomeData,
            'monthlyExpenseData' => $monthlyExpenseData,
        ];

        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_dashboard', $data);
        echo view('master/footer', $data);
    }


    //Pemasukan
    public function pemasukanindex()
    {
        $data['title']     = 'Pemasukan';
        $data['page']     = 'pemasukan';
        $model = new Income_model();
        $data['pemasukan'] = $model->getAllIncomes();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_pemasukan', $data);
        echo view('master/footer', $data);
    }

    public function pemasukanaddindex()
    {
        $data['title'] = 'Tambah Pemasukan';
        $data['page'] = 'pemasukan';
        $data['pemasukan'] = '';
        $model = new Income_model();
        $data['terakhir'] = $model->getLatestIncome();
        $model = new Produk_model();
        $data['produk'] = $model->getLastProduct();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_pemasukan', $data);
        echo view('master/footer', $data);
    }

    public function pemasukaneditindex($id)
    {
        $data['title'] = 'Edit Pemasukan';
        $data['page'] = 'pemasukan';
        $model = new Income_model();
        $data['pemasukan'] = $model->find($id);
        if (!$data['pemasukan']) {
            session()->setFlashdata('error', 'Pemasukan tidak ditemukan.');
            return redirect()->to('pemasukan');
        } else {
            echo view('master/header', $data);
            echo view('master/navbar', $data);
            echo view('master/sidebar', $data);
            echo view('form/v_form_pemasukan', $data);
            echo view('master/footer', $data);
        }
    }

    public function pemasukansave()
    {
        $session = \Config\Services::session();
        $model = new Income_model();
        
        $x = 20.14596;
        $id = $this->request->getPost('id');
        
        $tanggal = htmlspecialchars($this->request->getPost('tanggal'));
        $totalisatorAwal = (float) htmlspecialchars($this->request->getPost('totalisator_awal'));
        $totalisatorAkhir = (float) htmlspecialchars($this->request->getPost('totalisator_akhir'));
        $priceUnit = (float) htmlspecialchars($this->request->getPost('harga_satuan'));
        $dipping1 = (float) htmlspecialchars($this->request->getPost('dipping1'));
        $dipping4 = (float) htmlspecialchars($this->request->getPost('dipping4'));
        $pengiriman = htmlspecialchars($this->request->getPost('pengiriman'));
        $pumptes = htmlspecialchars($this->request->getPost('pumtes'));
        $tanggalHariIni = date("Y-m-d");

        if ($tanggal === false || $tanggal > $tanggalHariIni) {
            return redirect()->back()->withInput()->with('error', 'Tanggal tidak boleh melebihi tanggal hari ini!');
        }

        if (!is_numeric($totalisatorAwal) || !is_numeric($totalisatorAkhir) || !is_numeric($priceUnit) || !is_numeric($dipping1) || !is_numeric($dipping4)) {
            return redirect()->back()->withInput()->with('error', 'Masukkan harus berupa angka!');
        }

        $latestDateRecord = $model->orderBy('tanggal', 'DESC')->first();
        $latestDate = $latestDateRecord['tanggal'] ?? null;

        if ($latestDate && strtotime($tanggal) < strtotime($latestDate)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal harus lebih baru dari tanggal terakhir yang ada di data!');
        }

        if ($id) {
            $existingRecord = $model->findPemasukanByDate($tanggal);
            if ($existingRecord && $existingRecord['id'] !== $id) {
                return redirect()->back()->with('error', 'Tanggal sudah ada di data lain');
            }
        } else {
            if ($model->findPemasukanByDate($tanggal)) {
                return redirect()->back()->with('error', 'Tanggal sudah ada');
            }
        }

        $besartes = $pumptes === 'yes' ? (float) htmlspecialchars($this->request->getPost('besartes')) : null;
        $dipping2 = $pengiriman === 'yes' ? (float) htmlspecialchars($this->request->getPost('dipping2')) : null;
        $dipping3 = $pengiriman === 'yes' ? (float) htmlspecialchars($this->request->getPost('dipping3')) : null;
        $waktupengiriman = $pengiriman === 'yes' ? htmlspecialchars($this->request->getPost('waktupengiriman')) : null;

        $sales = $totalisatorAkhir - $totalisatorAwal - ($besartes ?? 0);
        
        $total = $sales * $priceUnit;

        $besarPengiriman = $pengiriman === 'yes' ? ($dipping3-$dipping2) *$x : null;
        
        if ($pengiriman === 'no') {
            $stokTerpakai = ($dipping1 - $dipping4)*$x;
        } else {
            $stokTerpakai = $waktupengiriman === 'Malam' 
                ? (($dipping1 - $dipping2 + $dipping3 - $dipping4 - $besarPengiriman)*$x)
                : (($dipping1 - $dipping2 + $dipping3 - $dipping4)*$x);
            
        }

        $losses = $sales - $stokTerpakai;

        $data = [
            'tanggal'           => $tanggal,
            'totalisator_awal'  => $totalisatorAwal,
            'totalisator_akhir' => $totalisatorAkhir,
            'sales'             => $sales,
            'price_unit'        => $priceUnit,
            'total'             => $total,
            'dipping1'          => $dipping1,
            'dipping2'          => $dipping2,
            'dipping3'          => $dipping3,
            'dipping4'          => $dipping4,
            'pengiriman'        => $pengiriman,
            'pumptes'           => $pumptes,
            'besartes'          => $besartes,
            'losses'            => $losses,
            'besar_pengiriman'  => $besarPengiriman,
            'waktupengiriman'   => $waktupengiriman,
            'stok_terpakai'     => $stokTerpakai
        ];

        if (empty($id)) {
            $model->insert($data);
            $session->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else {
            $model->update($id, $data);
            $session->setFlashdata('sukses', 'Data berhasil diperbarui!');
        }

        return redirect()->to('pemasukan');
    }

    public function pemasukandelete($id)
    {
        $session = \Config\Services::session();
        $model = new Income_model();

        $income = $model->find($id);

        if ($income) {
            $model->delete($id);
            $session->setFlashdata('sukses', 'Data berhasil dihapus!');
        } else {
            $session->setFlashdata('error', 'ID tidak valid atau tidak ditemukan.');
        }

        return redirect()->to('pemasukan');
    }


    //Pengeluaran
    public function pengeluaranindex()
    {
        $data['title']     = 'Pengeluaran';
        $data['page']     = 'pengeluaran';
        $model = new Expense_model();
        $data['pengeluaran'] = $model->getAllExpenses();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_pengeluaran', $data);
        echo view('master/footer', $data);
    }

    public function pengeluaransave()
    {
        $session = \Config\Services::session();
        $model = new Expense_model();
    
        $id = $this->request->getPost('id');
    
        $date = $this->request->getPost('date');
        $desc = $this->request->getPost('desc');
        $otherDesc = htmlspecialchars($this->request->getPost('other_desc'));
        $nominal = $this->request->getPost('nominal');
        $tanggalHariIni = date("Y-m-d");

        if ($date === false || $date > $tanggalHariIni) {
            return redirect()->back()->withInput()->with('error', 'Tanggal tidak boleh melebihi tanggal hari ini!');
        }
    
        if ($desc === 'Lainnya') {
            $desc = $otherDesc;
        }
    
        if (!is_numeric($nominal)) {
            return redirect()->back()->withInput()->with('error', 'Nominal harus berupa angka.');
        }
    
        $nominal = (float)$nominal;
    
        $data = [
            'date' => $date,
            'desc' => $desc,
            'nominal' => $nominal,
        ];
    
        if (empty($id)) {
            $model->insert($data);
            $session->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else {
            $model->update($id, $data);
            $session->setFlashdata('sukses', 'Data berhasil diperbarui!');
        }
    
        return redirect()->to('pengeluaran');
    }
    
    public function pengeluaranaddindex()
    {
        $model = new Expense_model();
        $uniqueDescriptions = $model->getUniqueDescriptions();

        $data['title'] = 'Tambah Pengeluaran';
        $data['page'] = 'pengeluaran';
        $data['pengeluaran'] = '';
        $data['uniqueDescriptions'] = $uniqueDescriptions;

        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_pengeluaran', $data);
        echo view('master/footer', $data);
    }

    public function pengeluaraneditindex($id)
    {
        $model = new Expense_model();
        $session = \Config\Services::session();

        $pengeluaran = $model->find($id);

        if (!$pengeluaran) {
            $session->setFlashdata('error', 'Data pengeluaran tidak ditemukan.');
            return redirect()->to('pengeluaran');
        }

        $uniqueDescriptions = $model->getUniqueDescriptions();

        $data = [
            'title' => 'Edit Pengeluaran',
            'page' => 'pengeluaran',
            'pengeluaran' => $pengeluaran,
            'uniqueDescriptions' => $uniqueDescriptions,
        ];

        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_pengeluaran', $data);
        echo view('master/footer', $data);
    }


    public function pengeluarandelete($id)
    {
        $session = \Config\Services::session();
        $model = new Expense_model();

        $pengeluaran = $model->find($id);

        if ($pengeluaran) {
            $model->delete($id);
            $session->setFlashdata('sukses', 'Berhasil menghapus data pengeluaran!');
        } else {
            $session->setFlashdata('error', 'Gagal menghapus data pengeluaran! Data tidak ditemukan.');
        }

        return redirect()->back();
    }

    //Laporan
    public function laporanindex()
    {
        $data['title']     = 'Laporan';
        $data['page']     = 'laporan';
        $model = new Income_model();
        $data['tanggal'] = $model->getUniqueDates();
        $jenis = $this->request->getPost('jenis_laporan');
        $tahun = $this->request->getPost('tahun');
        
        if (empty($jenis)){
            $data['laporan']   = '';
        } elseif ($jenis === "tahunan"){
            $reportModel = new Report_model();
            $data['laporan'] = $reportModel->getFinancialReport($tahun);
        } elseif ($jenis === "bulanan"){
            $bulan = $this->request->getPost('bulan');
            $reportModel = new Report_model();
            $data['laporan'] = $reportModel->getFinancialReport($tahun, $bulan);
        }
        $data['jenis']   = (empty($jenis)? '' : ucfirst($jenis));
        $data['tahun']   = (empty($tahun)? '' : $tahun);
        $data['bulan']   = (empty($bulan)? null : $bulan);
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_laporan', $data);
        echo view('master/footer', $data);
    }
    

    //Produk
    public function produkindex()
    {
        $data['title']     = 'Produk';
        $data['page']     = 'produk';
        $model = new Produk_model();
        $data['lastProduct'] = $model->getLastProduct();
        $formatter = new CurrencyFormatter();
        if ($data['lastProduct']) {
            $data['lastProduct']['harga_jual'] = $formatter->formatRupiah($data['lastProduct']['harga_jual']);
            $data['lastProduct']['harga_beli'] = $formatter->formatRupiah($data['lastProduct']['harga_beli']);
        }
        $model = new Income_model();
        $data['terakhir'] = $model->getLatestIncome();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_produk', $data);
        echo view('master/footer', $data);
    }

    public function produkedit()
    {
        $data['title']     = 'Edit Produk';
        $data['page']     = 'produk';
        $model = new Produk_model();
        $data['produk'] = $model->getLastProduct();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_produk', $data);
        echo view('master/footer', $data);
    }

    public function produkeditsave()
    { 
        $session = \Config\Services::session();
        $model = new Produk_model();
    
        $id = $this->request->getPost('id');
    
        $produk = $model->getProductById($id);
        if (!$produk) {
            $session->setFlashdata('error', 'ID produk tidak terdaftar. Silakan coba dengan ID yang valid!');
            return redirect()->to('produk');
        }
    
        $hargaBeli = $this->request->getPost('hargabeli');
        $hargaJual = $this->request->getPost('hargajual');
        if (!is_numeric($hargaBeli) || !is_numeric($hargaJual)) {
            return redirect()->back()->withInput()->with('error', 'Harga harus berupa angka.');

        }

        $hargaBeli = (float)$hargaBeli;
        $hargaJual = (float)$hargaJual;
    
        $data = [
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
        ];
    
        if ($model->updateProduct($id, $data)) {
            $session->setFlashdata('sukses', 'Berhasil mengupdate produk!');
            return redirect()->to('produk');
        } else {
            $session->setFlashdata('error', 'Gagal mengupdate produk. Silakan coba lagi!');
            return redirect()->back()->withInput();
        }
    }

    //Profil
    public function profilindex()
    {
        $data['title']     = 'Profil';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_profil', $data);
        echo view('master/footer', $data);
    }

    public function profiledit()
    {
        $data['title']     = 'Edit Profil';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_profil', $data);
        echo view('master/footer', $data);
    }

    public function profileditsave()
    {
        $session = \Config\Services::session();
        $model = new Pengguna_model;

        $id = $session->get('id');
        $usernameawal = $session->get('username');
        $username = htmlspecialchars($this->request->getPost('username'));
        $nama = htmlspecialchars($this->request->getPost('nama'));
        
        $data = array(
            'username'  => $username,
            'nama'      => $nama
        );
        if ($username != $usernameawal) {
            $getPengguna = $model->getByUsername($username);
            if (!isset($getPengguna)) {              
                $model->editPengguna($data, $id);
                $session->set([
                    'id' => $id,
                    'username' => $username,
                    'nama' => $nama
                ]);
                $session->setFlashdata('sukses', 'Berhasil mengedit data!');
                return redirect()->to('profil');
            } else {
                $session->setFlashdata('error', 'Username sudah tersedia, silahkan ganti username Anda!');
                return redirect()->back()->withInput();
            }
        } else {
            $model->editPengguna($data, $id);
            $session->set([
                'id' => $id,
                'username' => $username,
                'nama' => $nama
            ]);
            $session->setFlashdata('sukses', 'Berhasil mengedit data!');
            return redirect()->to('profil');
        }
    }

    public function passwordedit()
    {
        $data['title']     = 'Edit Password';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_password', $data);
        echo view('master/footer', $data);
    }

    public function passwordeditsave()
    {
        $session = \Config\Services::session();
        $model = new Pengguna_model;

        $id = $session->get('id');
        
        $passlama = htmlspecialchars($this->request->getPost('passwordlama'));
        $passbaru = htmlspecialchars($this->request->getPost('passwordbaru'));
        $konpassbaru = htmlspecialchars($this->request->getPost('konfirmasipasswordbaru'));

        if ($passbaru === $konpassbaru) {
            $getPengguna = $model->getByid($id);

            if ($getPengguna) {
                if (password_verify($passlama, $getPengguna['password'])) {
                    $hashedPassword = password_hash($passbaru, PASSWORD_DEFAULT);
                    
                    $data = [
                        'password' => $hashedPassword
                    ];
                    $model->editPengguna($data, $id);
                    
                    $session->setFlashdata('sukses', 'Berhasil mengedit password!');
                    return redirect()->to('profil');
                } else {
                    $session->setFlashdata('error', 'Password Lama Anda Salah, Silakan coba lagi!!');
                    return redirect()->back()->withInput();
                }
            } else {
                $session->setFlashdata('error', 'Pengguna tidak ditemukan. Silakan coba lagi!');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Password Baru dan Konfirmasi Password Berbeda. Silakan coba lagi!!');
            return redirect()->back()->withInput();
        }
    }

}
