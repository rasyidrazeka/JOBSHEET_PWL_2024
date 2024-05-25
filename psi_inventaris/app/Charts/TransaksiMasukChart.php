<?php

namespace App\Charts;

use App\Models\TransaksiMasukModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class TransaksiMasukChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $transaksiMasuks = TransaksiMasukModel::selectRaw('YEAR(tanggal_diterima) as year, Month(tanggal_diterima) as month, SUM(qty) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        $labels = [];
        $data = [];
    
        foreach ($transaksiMasuks as $transaksiMasuk) {
            $labels[] = Carbon::createFromDate($transaksiMasuk->year, $transaksiMasuk->month, 1)->format('F Y');
            $data[] = $transaksiMasuk->total;
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
