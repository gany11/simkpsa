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
        
        // Ambil input username dan password
        $username = htmlspecialchars($this->request->getPost('username'), ENT_QUOTES, 'UTF-8');
        $pass1 = htmlspecialchars($this->request->getPost('password'));
        
        // Panggil model pengguna
        $model = new Pengguna_model;
        
        // Ambil data pengguna berdasarkan username (bukan password)
        $getPengguna = $model->getPenggunaByUsername($username)->getRow();
        
        // Periksa apakah pengguna ditemukan
        if (isset($getPengguna)) {
            // Verifikasi password menggunakan password_verify()
            if (password_verify($pass1, $getPengguna->password)) {
                // Jika password benar, set session pengguna
                $session->set([
                    'id' => $getPengguna->id,
                    'username' => $getPengguna->username,
                    'nama' => (empty($getPengguna->nama) ? $getPengguna->username : $getPengguna->nama)
                ]);
                return redirect()->to('/');
            } else {
                // Password salah
                $session->setFlashdata('error', 'Gagal! Username atau password yang Anda masukkan salah!');
                return redirect()->back();
            }
        } else {
            // Pengguna tidak ditemukan
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
