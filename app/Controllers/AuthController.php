<?php

namespace App\Controllers;

use App\Models\AuthModel;
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

    // public function attemptLogin()
    // {
    //     $session = session();
    //     $model = new AuthModel();
    //     $db = \Config\Database::connect();
        
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');
    
    //     $user = $model->where('email', $email)->first();
    
    //     if ($user) {
    //         if (password_verify($password, $user['password'])) {
    //             echo "Password cocok!<br>";
    
    //             $nama = 'Guest'; 
    
                
    //             if ($user['roles_id'] == 1) { 
    //                 $result = $db->table('admin')
    //                     ->select('admin.nama')
    //                     ->where('users_id', $user['id'])
    //                     ->get()
    //                     ->getRowArray();
    //                 if ($result) {
    //                     $nama = $result['nama'];
    //                 }
    //             } elseif ($user['roles_id'] == 2 || $user['roles_id'] == 3) { 
    //                 $result = $db->table('pengguna')
    //                     ->select('pengguna.nama')
    //                     ->where('users_id', $user['id'])
    //                     ->get()
    //                     ->getRowArray();
    //                 if ($result) {
    //                     $nama = $result['nama'];
    //                 }
    //             }
    
               
    //             $session->set([
    //                 'user_id' => $user['id'],
    //                 'nama' => $nama, 
    //                 'role' => $user['roles_id'],
    //                 'logged_in' => true
    //             ]);
    
    //             return redirect()->to($this->getDashboardRoute($user['roles_id']));
    //         } else {
    //             echo "Password tidak cocok!<br>";
    //         }
    //     } else {
    //         echo "Email tidak ditemukan!<br>";
    //     }
    
    //     return redirect()->back()->with('error', 'Maaf, Email atau Password Salah');
    // }
    
    public function attemptLogin()
    {
        $session = session();
        $model = new AuthModel();
        $db = \Config\Database::connect();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                echo "Password cocok!<br>";

                $nama = null; 
                $table = '';

                switch ($user['roles_id']) {
                    case 1: 
                        $table = 'admin';
                        break;
                    case 2: 
                        $table = 'petugas';
                        break;
                    case 3: 
                        $table = 'pengguna';
                        break;
                    case 4: 
                        $table = 'teknisi';
                        break;
                    default:
                        return redirect()->back()->with('error', 'Role tidak valid.');
                }

                $result = $db->table($table)
                    ->select('nama')
                    ->where('users_id', $user['id'])
                    ->get()
                    ->getRowArray();

                if ($result) {
                    $nama = $result['nama'];
                }

                $session->set([
                    'user_id' => $user['id'],
                    'nama' => $nama, 
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

        return redirect()->back()->with('error', 'Maaf, Email atau Password Salah');
    }


    
    private function getDashboardRoute($role)
    {
        switch ($role) {
            case 1:
                return '/admin/dashboard';
            case 2:
                return '/petugas/dashboard';
            case 3:
                return '/user/dashboard';
            case 4:
                return '/teknisi/dashboard';
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
            case 4:
                return redirect()->to('/teknisi/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}
