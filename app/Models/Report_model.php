<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Income_model;
use App\Models\Expense_model;

class Report_model extends Model
{
    protected $incomeModel;
    protected $expenseModel;

    public function __construct()
    {
        $this->incomeModel = new Income_model();
        $this->expenseModel = new Expense_model();
    }

    public function getFinancialReport($year, $month = null)
    {
        $incomes = $this->incomeModel->getIncomesForReport($year, $month);
        $expenses = $this->expenseModel->getExpensesForReport($year, $month);

        $merged = array_merge($incomes, $expenses);
        usort($merged, function($a, $b) {
            return strtotime($a['date']) <=> strtotime($b['date']);
        });

        $incomeSummary = $this->incomeModel->calculateIncomeSummary($year, $month);
        $expenseSummary = $this->expenseModel->calculateExpenseSummary($year, $month);

        return [
            'data' => $merged,
            'total_sales' => $incomeSummary['total_sales'],
            'total_pendapatan' => $incomeSummary['total_pendapatan'],
            'total_pengeluaran' => $expenseSummary['total_pengeluaran'],
            'total_stok_terpakai' => $incomeSummary['total_stok_terpakai'],
            'total_losess' => $incomeSummary['total_losses'],
            'total_pengiriman' => $incomeSummary['total_pengiriman'],
            'total_tes' => $incomeSummary['total_tes'],
            'jumlah_pengiriman' => $incomeSummary['jumlah_pengiriman'],
            'jumlah_pumptes' => $incomeSummary['jumlah_pumptes'],
        ];
    }
}
