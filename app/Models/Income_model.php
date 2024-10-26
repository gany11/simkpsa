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
}