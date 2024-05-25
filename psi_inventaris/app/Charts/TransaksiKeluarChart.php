<?php

namespace App\Charts;

use App\Models\TransaksiKeluarModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class TransaksiKeluarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $transaksiKeluars = TransaksiKeluarModel::selectRaw('YEAR(tanggal_keluar) as year, Month(tanggal_keluar) as month, SUM(qty) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        $labels = [];
        $data = [];
    
        foreach ($transaksiKeluars as $transaksiKeluar) {
            $labels[] = Carbon::createFromDate($transaksiKeluar->year, $transaksiKeluar->month, 1)->format('F Y');
            $data[] = $transaksiKeluar->total;
        }

        return $this->chart->lineChart()
            ->setXAxis($labels)
            ->setDataset([
                [
                'name' => 'Total Transaksi',
                'data' => $data
                ]
            ])
            ->setHeight(300);
    }
}
