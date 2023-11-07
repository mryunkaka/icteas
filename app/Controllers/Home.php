<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $helpers = ['custom'];
    public function index()
    {
        return view('home');
    }
    public function tes()
    {
        return view('tes');
    }
}
