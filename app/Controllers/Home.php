<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/fitur/fileInti/dashboardUtama');
    }
    public function index2()
    {
        return view('admin/layout/default');
    }
}