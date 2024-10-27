<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Expense_model extends Model
{
    protected $table = 'expense'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = [
        'date',
        'desc',
        'nominal',
    ]; // Kolom yang bisa diisi

    // Mendapatkan semua data
    public function getAllExpenses()
    {
        return $this->orderBy('date', 'DESC')->findAll();
    }

    public function getAllExpensesASC()
    {
        return $this->orderBy('date', 'ASC')->findAll();
    }

    // Mengambil deskripsi unik
    public function getUniqueDescriptions()
    {
        $results = $this->select('desc')
                        ->distinct()
                        ->findAll();

        return array_column($results, 'desc'); // Mengambil hanya kolom 'desc' dari hasil
    }


    // Mendapatkan data berdasarkan tanggal terbaru
    public function getLatestExpense()
    {
        return $this->orderBy('date', 'DESC')->first();
    }

    //Report

    public function getExpensesForReport($year, $month = null)
    {
        $this->select("date, desc AS keterangan, NULL AS pemasukan, nominal AS pengeluaran");
        $this->where("YEAR(date)", $year);
        
        if ($month) {
            $this->where("MONTH(date)", $month);
        }

        return $this->orderBy('date', 'ASC')->findAll();
    }

    public function calculateExpenseSummary($year, $month = null)
    {
        $this->selectSum('nominal', 'total_pengeluaran')
             ->where("YEAR(date)", $year);

        if ($month) {
            $this->where("MONTH(date)", $month);
        }

        return $this->get()->getRowArray();
    }
}