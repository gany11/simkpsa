<?php

namespace App\Libraries;

class FormatNumber
{
    public function format($number)
    {
        // Cek jika input adalah angka
        if (!is_numeric($number)) {
            return $number;
        }

        // Menggunakan number_format untuk memformat angka
        return number_format($number, 2, ',', '.');
    }
}

    // <?php
    // // Memuat library FormatNumber
    // $formatNumber = new \App\Libraries\FormatNumber();

    // // Contoh angka
    // $number = 100000.00; 

    // // Menampilkan angka yang diformat
    // echo $formatNumber->format($number);
    // ?>