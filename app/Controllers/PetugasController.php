<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class PetugasController extends Controller
{
    public function index()
    {
        $petugasModel = new PetugasModel();
        $data['petugas'] = $petugasModel->getPetugasname(); 

        return view('petugas/dashboard',$data);
    }
}
