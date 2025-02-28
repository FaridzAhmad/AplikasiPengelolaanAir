<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = [];
    }

    public function index()
    {
        // $session = session();
        // $userModel = new UserModel();

        // // Ambil ID user dari session
        // $userId = $session->get('user_id'); 

        //
        // if (!$userId) {
        //     return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        // }

        //
        // $this->user = $userModel->getUserName($userId);

        // // 
        return view('user/dashboard', ['users' => $this->user]);
    }
}



