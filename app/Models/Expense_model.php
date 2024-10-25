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
}