<?php

namespace App\Libraries;

class CurrencyFormatter
{
    // Fungsi untuk mengonversi desimal ke format Rupiah
    public function formatRupiah($amount)
    {
        return 'Rp' . number_format($amount, 2, ',', '.');
    }
}
