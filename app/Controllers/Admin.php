<?php

namespace App\Controllers;
    
class Admin extends BaseController
{
    public function index()
    {
        $data['title']     = 'Profil';
        $data['page']     = 'Profil';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_Profil', $data);
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
}
