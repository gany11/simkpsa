<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Income_model extends Model
{
    protected $table = 'income'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = [
        'tanggal', 
        'totalisator_awal', 
        'totalisator_akhir', 
        'sales', 
        'price_unit', 
        'total', 
        'dipping1', 
        'dipping2', 
        'dipping3', 
        'dipping4', 
        'pengiriman', 
        'besar_pengiriman', 
        'pumptes', 
        'besartes', 
        'losess'
    ]; // Kolom yang bisa diisi
    protected $useTimestamps = false; // Jika Anda tidak menggunakan timestamp

    // Mendapatkan semua data
    public function getAllIncomes()
    {
        return $this->findAll();
    }

    // Mendapatkan data berdasarkan ID
    public function getIncomeById($id)
    {
        return $this->find($id);
    }

    // Menambah data baru
    public function addIncome($data)
    {
        return $this->insert($data);
    }

    // Mengedit data
    public function updateIncome($id, $data)
    {
        return $this->update($id, $data);
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
}