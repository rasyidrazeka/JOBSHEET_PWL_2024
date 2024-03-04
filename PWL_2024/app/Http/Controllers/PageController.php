<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return 'Selamat Datang';
    }
    public function about(){
        return 'Rasyid Razeka A - 2141762077';
    }
    public function articles($articleId){
        return 'Halaman artikel dengan id: ' . $articleId;
    }
}
