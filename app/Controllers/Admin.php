<?php

namespace App\Controllers;
use App\Models\Produk_model;
use App\Models\Pengguna_model;
use App\Models\Income_model;
use App\Models\Expense_model;
use App\Libraries\CurrencyFormatter;
    
class Admin extends BaseController
{
    public function index()
    {
        $data['title']     = 'Dashboard';
        $data['page']     = 'dashboard';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_dashboard', $data);
        echo view('master/footer', $data);
    }

    //Produk
    public function produkindex()
    {
        $data['title']     = 'Produk';
        $data['page']     = 'produk';
        $model = new Produk_model();
        $data['lastProduct'] = $model->getLastProduct();
        // Memanggil library untuk format harga
        $formatter = new CurrencyFormatter();
        if ($data['lastProduct']) {
            $data['lastProduct']['harga_jual'] = $formatter->formatRupiah($data['lastProduct']['harga_jual']);
            $data['lastProduct']['harga_beli'] = $formatter->formatRupiah($data['lastProduct']['harga_beli']);
        }
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_produk', $data);
        echo view('master/footer', $data);
    }

    //Profil
    public function profilindex()
    {
        $data['title']     = 'Profil';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_profil', $data);
        echo view('master/footer', $data);
    }

    public function profiledit()
    {
        $data['title']     = 'Edit Profil';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_profil', $data);
        echo view('master/footer', $data);
    }

    public function profileditsave()
    {
        $session = \Config\Services::session();
        $model = new Pengguna_model;

        // Ambil ID dari session
        $id = $session->get('id');
        $usernameawal = $session->get('username');
        $username = htmlspecialchars($this->request->getPost('username'));
        $nama = htmlspecialchars($this->request->getPost('nama'));
        
        $data = array(
            'username'  => $username,
            'nama'      => $nama
        );
        if ($username != $usernameawal) {
            $getPengguna = $model->getByUsername($username);
            if (!isset($getPengguna)) {              
                $model->editPengguna($data, $id);
                $session->set([
                    'id' => $id,
                    'username' => $username,
                    'nama' => $nama
                ]);
                $session->setFlashdata('sukses', 'Berhasil mengedit data!');
                return redirect()->to('profil');
            } else {
                $session->setFlashdata('error', 'Username sudah tersedia, silahkan ganti username Anda!');
                return redirect()->to('profil');
            }
        } else {
            $model->editPengguna($data, $id);
            $session->set([
                'id' => $id,
                'username' => $username,
                'nama' => $nama
            ]);
            $session->setFlashdata('sukses', 'Berhasil mengedit data!');
            return redirect()->to('profil');
        }
    }

    public function passwordedit()
    {
        $data['title']     = 'Edit Password';
        $data['page']     = 'profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_password', $data);
        echo view('master/footer', $data);
    }

    public function passwordeditsave()
    {
        $session = \Config\Services::session();
        $model = new Pengguna_model;

        // Ambil ID dari session
        $id = $session->get('id');
        $passlama = base64_encode(htmlspecialchars($this->request->getPost('passwordlama')));
        $passbaru = base64_encode(htmlspecialchars($this->request->getPost('passwordbaru')));
        $konpassbaru = base64_encode(htmlspecialchars($this->request->getPost('konfirmasipasswordbaru')));

        $data = array(
            'password'  => $passbaru
        );

        if ($passbaru === $konpassbaru) {
            $getPengguna = $model->getByid($id);
            
            // Pastikan pengguna ditemukan sebelum memeriksa password
            if ($getPengguna) {
                // Periksa apakah password lama yang dimasukkan benar
                if ($passlama === $getPengguna['password']) {
                    // Hash password baru sebelum menyimpannya
                    $data = [
                        'password' => $passbaru
                    ];
                    $model->editPengguna($data, $id);
                    $session->setFlashdata('sukses', 'Berhasil mengedit password!');
                    return redirect()->to('profil');
                } else {
                    $session->setFlashdata('error', 'Password Lama Anda Salah!');
                    return redirect()->to('profil');
                }
            } else {
                $session->setFlashdata('error', 'Pengguna tidak ditemukan!');
                return redirect()->to('profil');
            }
        } else {
            $session->setFlashdata('error', 'Password Baru dan Konfirmasi Password Berbeda!');
            return redirect()->to('profil');
        }        
    }
}
