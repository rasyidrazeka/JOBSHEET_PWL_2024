<?php

namespace App\Charts;

use App\Models\AdministrasiModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Collection;

class AdministrasiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $users = AdministrasiModel::with('level')
            ->select('level_id', \App\Models\AdministrasiModel::raw('count(*) as total'))
            ->groupBy('level_id')
            ->get();

        $levels = [];
        $counts = [];

        foreach ($users as $user) {
                $levels[] = $user->level->level_nama;
                $counts[] = $user->total;
        }

        return $this->chart->pieChart()
            ->addData($counts)
            ->setLabels($levels)
            ->setHeight(313);
    }
}
