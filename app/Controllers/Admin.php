<?php

namespace App\Controllers;
    
class Admin extends BaseController
{
    public function index()
    {
        $data['title']     = 'PT Perta Sakti Abadi | Dashboard';
        $data['page']     = 'dashboard';
        echo view('master/header', $data);
        echo view('master/navbar', $data);
        echo view('master/sidebar', $data);
        echo view('v_dashboard', $data);
        echo view('master/footer', $data);
    }
}
