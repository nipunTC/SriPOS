<?php

namespace App\Controllers;

class Products extends BaseController
{
    public function index()
    {
        return view('dashboard/products');
    }
}
