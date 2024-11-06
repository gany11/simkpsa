<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Produk_model extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['harga_jual', 'harga_beli'];

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