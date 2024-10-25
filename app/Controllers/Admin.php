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

    public function produkedit()
    {
        $data['title']     = 'Edit Produk';
        $data['page']     = 'produk';
        $model = new Produk_model();
        $data['produk'] = $model->getLastProduct();
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('form/v_form_edit_produk', $data);
        echo view('master/footer', $data);
    }

    public function produkeditsave()
    { 
        $session = \Config\Services::session();
        $model = new Produk_model();
    
        // Ambil ID produk dari parameter post
        $id = $this->request->getPost('id');
    
        // Cek apakah produk ada di database
        $produk = $model->getProductById($id);
        if (!$produk) {
            $session->setFlashdata('error', 'ID produk tidak terdaftar. Silakan coba dengan ID yang valid!');
            return redirect()->to('produk');
        }
    
        $hargaBeli = str_replace('.', '', $this->request->getPost('hargabeli'));
        $hargaJual = str_replace('.', '', $this->request->getPost('hargajual'));
    
        // Validasi input
        $this->validate([
            'hargabeli' => 'required|numeric',
            'hargajual' => 'required|numeric',
        ]);
    
        // Data yang akan diupdate
        $data = [
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
        ];
    
        // Melakukan update
        if ($model->updateProduct($id, $data)) {
            $session->setFlashdata('sukses', 'Berhasil mengupdate produk!');
            return redirect()->to('produk'); // Ganti dengan route yang sesuai
        } else {
            $session->setFlashdata('error', 'Gagal mengupdate produk. Silakan coba lagi!');
            return redirect()->back()->withInput();
        }
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
                return redirect()->back()->withInput();
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
        
        // Ambil input dari form
        $passlama = htmlspecialchars($this->request->getPost('passwordlama'));
        $passbaru = htmlspecialchars($this->request->getPost('passwordbaru'));
        $konpassbaru = htmlspecialchars($this->request->getPost('konfirmasipasswordbaru'));

        // Pastikan password baru dan konfirmasi password sama
        if ($passbaru === $konpassbaru) {
            $getPengguna = $model->getByid($id);

            // Pastikan pengguna ditemukan
            if ($getPengguna) {
                // Verifikasi apakah password lama benar
                if (password_verify($passlama, $getPengguna['password'])) {
                    // Hash password baru sebelum menyimpannya
                    $hashedPassword = password_hash($passbaru, PASSWORD_DEFAULT);
                    
                    // Update password di database
                    $data = [
                        'password' => $hashedPassword
                    ];
                    $model->editPengguna($data, $id);
                    
                    // Set pesan sukses dan redirect
                    $session->setFlashdata('sukses', 'Berhasil mengedit password!');
                    return redirect()->to('profil');
                } else {
                    // Password lama salah
                    $session->setFlashdata('error', 'Password Lama Anda Salah, Silakan coba lagi!!');
                    return redirect()->back()->withInput();
                }
            } else {
                // Pengguna tidak ditemukan
                $session->setFlashdata('error', 'Pengguna tidak ditemukan. Silakan coba lagi!');
                return redirect()->back()->withInput();
            }
        } else {
            // Password baru dan konfirmasi tidak cocok
            $session->setFlashdata('error', 'Password Baru dan Konfirmasi Password Berbeda. Silakan coba lagi!!');
            return redirect()->back()->withInput();
        }
    }

}
