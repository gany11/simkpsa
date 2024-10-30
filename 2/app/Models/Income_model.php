<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Income_model extends Model
{
    protected $table = 'income'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields    = [
        'tanggal', 'totalisator_awal', 'totalisator_akhir', 'sales', 'price_unit', 'total', 'dipping1', 'dipping2',
        'dipping3', 'dipping4', 'pengiriman', 'pumptes', 'besartes', 'losses', 'besar_pengiriman', 'waktupengiriman', 'stok_terpakai'
    ];

    public function findPemasukanByDate($tanggal)
    {
        return $this->where('tanggal', $tanggal)->first();
    }

    public function updateOrInsertPemasukan($data, $id = null)
    {
        if ($id) {
            return $this->update($id, $data);
        }
        return $this->insert($data);
    }

    // Mendapatkan semua data
    public function getAllIncomes()
    {
        return $this->orderBy('tanggal', 'DESC')->findAll();
    }

    public function getAllIncomesASC()
    {
        return $this->orderBy('tanggal', 'ASC')->findAll();
    }

    // Mendapatkan data berdasarkan ID
    public function getIncomeById($id)
    {
        return $this->find($id);
    }
    
    // Menghapus data
    public function deleteIncome($id)
    {
        return $this->delete($id);
    }

    // Mendapatkan data berdasarkan tanggal terbaru
    public function getLatestIncome()
    {
        return $this->orderBy('tanggal', 'DESC')->first();
    }

    public function getUniqueDates()
    {
        // Query untuk mengambil tanggal unik dari income dan expense
        $query = $this->db->query("
            SELECT DISTINCT unique_date FROM (
                SELECT tanggal AS unique_date FROM income
                UNION ALL
                SELECT date AS unique_date FROM expense
            ) AS combined_dates
            ORDER BY unique_date
        ");

        return $query->getResultArray(); // Mengembalikan hasil sebagai array
    }

    //Report
    public function getIncomesForReport($year, $month = null)
    {
        $this->select("tanggal AS date, CONCAT('Pemasukan ', tanggal) AS keterangan, total AS pemasukan, NULL AS pengeluaran");
        $this->where("YEAR(tanggal)", $year);
        
        if ($month) {
            $this->where("MONTH(tanggal)", $month);
        }

        return $this->orderBy('tanggal', 'ASC')->findAll();
    }

    public function calculateIncomeSummary($year, $month = null)
    {
        $this->selectSum('sales', 'total_sales')
            ->selectSum('total', 'total_pendapatan')
            ->selectSum('stok_terpakai', 'total_stok_terpakai')
            ->selectSum('losses', 'total_losses')
            ->selectSum('besar_pengiriman', 'total_pengiriman')
            ->selectSum('besartes', 'total_tes')
            ->select('SUM(CASE WHEN pengiriman = "yes" THEN 1 ELSE 0 END) AS jumlah_pengiriman')
            ->select('SUM(CASE WHEN pumptes = "yes" THEN 1 ELSE 0 END) AS jumlah_pumptes')
            ->where("YEAR(tanggal)", $year);

        if ($month) {
            $this->where("MONTH(tanggal)", $month);
        }

        return $this->get()->getRowArray();
    }

    //Dashboard
    public function getMonthlyTotals($year, $month)
    {
        return $this->select('
                SUM(sales) AS total_sales, 
                SUM(total) AS total_pendapatan, 
                SUM(stok_terpakai) AS total_stok_terpakai, 
                SUM(losses) AS total_losses, 
                SUM(besar_pengiriman) AS total_pengiriman
            ')
            ->where('YEAR(tanggal)', $year)
            ->where('MONTH(tanggal)', $month)
            ->first();
    }

    //2
    public function getDailyIncome($year, $month)
    {
        return $this->select('tanggal, total')
                    ->where('YEAR(tanggal)', $year)
                    ->where('MONTH(tanggal)', $month)
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }


    public function getMonthlyIncome($year)
    {
        return $this->select("MONTH(tanggal) as month, SUM(total) as total")
                    ->where("YEAR(tanggal)", $year)
                    ->groupBy("MONTH(tanggal)")
                    ->orderBy("MONTH(tanggal)", "ASC")
                    ->findAll();
    }

}