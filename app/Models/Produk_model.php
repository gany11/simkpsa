<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Produk_model extends Model
{
    protected $table = 'produk'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['harga_jual', 'harga_beli']; // Kolom yang bisa diisi
    protected $useTimestamps = false; // Jika Anda tidak menggunakan timestamp

    public function getProductById($id)
    {
        return $this->find($id);
    }

    // Mengedit produk
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    // Mendapatkan produk terakhir
    public function getLastProduct()
    {
        return $this->orderBy('id', 'DESC')->first();
    }
}