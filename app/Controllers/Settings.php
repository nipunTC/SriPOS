<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Settings';
        return view('dashboard/settings', $data);
    }
}
