<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TeknisiModel;

class TeknisiController extends Controller
{
    public function index()
    {
        // $teknisiModel = new TeknisiModel();
        // $data['teknisi'] = $teknisiModel->getTeknisiname(); 
        // dd(session()->get());

        return view('teknisi/dashboard');
    }
}
