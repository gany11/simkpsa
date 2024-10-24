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
    protected $useTimestamps = false; // Jika Anda tidak menggunakan timestamp

    // Mendapatkan semua data
    public function getAllExpenses()
    {
        return $this->findAll();
    }

    // Mendapatkan data berdasarkan ID
    public function getExpenseById($id)
    {
        return $this->find($id);
    }

    // Menambah data baru
    public function addExpense($data)
    {
        return $this->insert($data);
    }

    // Mengedit data
    public function updateExpense($id, $data)
    {
        return $this->update($id, $data);
    }

    // Menghapus data
    public function deleteExpense($id)
    {
        return $this->delete($id);
    }

    // Mendapatkan data berdasarkan tanggal terbaru
    public function getLatestExpense()
    {
        return $this->orderBy('date', 'DESC')->first();
    }
}