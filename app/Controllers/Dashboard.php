<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // set page title
        $data['title'] = 'Dashboard - SriPOS';
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }else{
            return view('dashboard/dashboard', $data);
        }
    }
}
