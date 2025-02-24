<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->has('logged_in') && session()->get('logged_in') === true) {
            return $this->redirectUser();
        }
        return view('auth/login');
    }

    public function attemptLogin()
{
    $session = session();
    $model = new LoginModel();
    
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if ($user) {

        if (password_verify($password, $user['password'])) {
            echo "Password cocok!<br>";

            $session->set([
                'user_id' => $user['id'],
                'role' => $user['roles_id'],
                'logged_in' => true
            ]);

            return redirect()->to($this->getDashboardRoute($user['roles_id']));
        } else {
            echo "Password tidak cocok!<br>";
        }
    } else {
        echo "Email tidak ditemukan!<br>";
    }

    return redirect()->back()->with('error', 'Maaf Email Atau Password Salah');
}

    // Fungsi untuk menentukan dashboard berdasarkan role
    private function getDashboardRoute($role)
    {
        switch ($role) {
            case 1:
                return '/admin/dashboard';
            case 2:
                return '/petugas/dashboard';
            case 3:
                return '/user/dashboard';
            default:
                return '/login';
        }
    }


    public function logout()
    {  
        session()->destroy();
        return redirect()->to('/login');
    }
   
    private function redirectUser()
    {
        switch (session()->get('role')) {
            case 1:
                return redirect()->to('/admin/dashboard');
            case 2:
                return redirect()->to('/petugas/dashboard');
            case 3:
                return redirect()->to('/user/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}
