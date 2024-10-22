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
 
    // public function savePengguna($data)
    // {
    //     $builder = $this->db->table($this->table);
    //     return $builder->insert($data);
    // }

    public function editPengguna($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }

    // public function hapusPengguna($id)
    // {
    //     $builder = $this->db->table($this->table);
    //     return $builder->delete(['id' => $id]);
    // }
}