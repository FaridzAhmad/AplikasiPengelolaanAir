<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class AdminController extends Controller
{
    public function index()
    {
        $adminModel = new AdminModel();
        $data['admins'] = $adminModel->getAdminName(); 

        return view('admin/dashboard', $data); 
    }

}
