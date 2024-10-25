<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Pengguna_model extends Model
{
    protected $table = 'pengguna';
 
    public function getPengguna($username = false, $password = false)
    {
        if ($username === false && $password === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['username' => $username, 'password' => $password]);
        }     
    }

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getPenggunaByUsername($username)
    {
        return $this->where('username', $username)->get();
    }


    public function editPengguna($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }
}