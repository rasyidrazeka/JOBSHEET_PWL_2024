<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Total Barang', \App\Models\BarangModel::query()->pluck('volume')->toArray())
            ->setXAxis(\App\Models\BarangModel::query()->pluck('barang_nama')->toArray())
            ->setHeight(300);
    }
}
