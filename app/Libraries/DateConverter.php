<?php

namespace App\Libraries;

class DateConverter
{
    protected $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];

    protected $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public function formatTanggal($tanggal)
    {
        $date = date_create($tanggal);
        if ($date) {
            $dayOfWeek = $this->days[date_format($date, 'l')];
            return $dayOfWeek . ', ' . date_format($date, 'd/m/Y');
        }
        return null;
    }

    public function formatTanggalBulanText($tanggal)
    {
        $date = date_create($tanggal);
        if ($date) {
            $dayOfWeek = $this->days[date_format($date, 'l')];
            $month = $this->months[(int)date_format($date, 'n')];
            return $dayOfWeek . ', ' . date_format($date, 'd') . ' ' . $month . ' ' . date_format($date, 'Y');
        }
        return null;
    }

    public function getBulanNama($bulan)
    {
        if (array_key_exists($bulan, $this->months)) {
            return $this->months[$bulan];
        }
        return null; // Return null if the month number is invalid
    }
}
