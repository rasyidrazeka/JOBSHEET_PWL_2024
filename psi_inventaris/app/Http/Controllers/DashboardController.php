<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Dashboard Inventaris',
            'list' => ['Home', 'Dashboard']
        ];
        $activeMenu = 'dashboard';
        return view('dashboard.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
