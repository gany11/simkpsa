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