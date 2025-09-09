<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        // set page title
        $data['title'] = 'Dashboard - SriPOS';
        return view('dashboard/dashboard', $data);
    }
}
