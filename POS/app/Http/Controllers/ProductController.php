<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function foodBaverage()
    {
        return view('product', ['name' => 'Food Baverage']);
    }

    public function beautyHealth()
    {
        return view('product', ['name' => 'Beauty Health']);
    }

    public function homeCare()
    {
        return view('product', ['name' => 'Home Care']);
    }

    public function babyKid()
    {
        return view('product', ['name' => 'Baby Kid']);
    }
}
