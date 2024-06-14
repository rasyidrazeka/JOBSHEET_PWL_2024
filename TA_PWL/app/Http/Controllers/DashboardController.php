<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('dashboard.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
