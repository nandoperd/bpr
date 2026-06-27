<?php

namespace App\Controllers;

use App\Models\ModelHome;

class Home extends BaseController
{   
    public function __construct()
    {
        helper('form');
        $this->ModelHome = new ModelHome();
    }

    public function index()
    {
        $data = [
            'title' => 'Customer Care'
        ];
        return view('beranda', $data);
    }
}
