<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['kategori_id'=>1, 'kategori_kode'=>'kt1', 'kategori_nama'=>'food-beverage'],
            ['kategori_id'=>2, 'kategori_kode'=>'kt2', 'kategori_nama'=>'beauty-health'],
            ['kategori_id'=>3, 'kategori_kode'=>'kt3', 'kategori_nama'=>'home-care'],
            ['kategori_id'=>4, 'kategori_kode'=>'kt4', 'kategori_nama'=>'baby-kid'],
            ['kategori_id'=>5, 'kategori_kode'=>'kt5', 'kategori_nama'=>'handsome-boy'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
