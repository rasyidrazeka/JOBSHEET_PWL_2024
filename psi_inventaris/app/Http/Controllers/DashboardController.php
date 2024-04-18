<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Dashboard Inventaris',
            'list' => ['Home', 'Dashboard']
        ];
        $activeMenu = 'dashboard';
        return view('dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
