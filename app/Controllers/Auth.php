<?php

namespace App\Controllers;
use App\Models\Pengguna_model;
    
class Auth extends BaseController
{

    //Login
    public function index()
    {
        return view('v_login');
    }

    public function in()
    {
        $session = \Config\Services::session();
        
        $username = htmlspecialchars($this->request->getPost('username'), ENT_QUOTES, 'UTF-8');
        $pass1 = htmlspecialchars($this->request->getPost('password'));
        
        $model = new Pengguna_model;
        $getPengguna = $model->getPenggunaByUsername($username)->getRow();
        
        if (isset($getPengguna)) {
            if (password_verify($pass1, $getPengguna->password)) {
                $session->set([
                    'id' => $getPengguna->id,
                    'username' => $getPengguna->username,
                    'nama' => (empty($getPengguna->nama) ? $getPengguna->username : $getPengguna->nama)
                ]);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('error', 'Gagal! Username atau password yang Anda masukkan salah!');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Gagal! Username atau password yang Anda masukkan salah!');
            return redirect()->back();
        }
    }
    

    //Logout
    public function out()
    {   
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
