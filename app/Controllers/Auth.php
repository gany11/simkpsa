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
        $password = base64_encode($this->request->getPost('password'));
        $model = new Pengguna_model;
        $getPengguna = $model->getPengguna($username, $password)->getRow();
        if (isset($getPengguna)) {
            $session->set([
                'id' => $getPengguna->id,
                'username' => $getPengguna->username,
                'nama' => (empty($getPengguna->nama) ? $getPengguna->username : $getPengguna->nama)
            ]);
            return redirect()->to('/');
            // $session->setFlashdata('sukses', 'Berhasil! Username atau password yang Anda masukkan benar!');
            // return redirect()->back();
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
