<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->getUserName(); 

        return view('user/dashboard',$data);
    }
}
