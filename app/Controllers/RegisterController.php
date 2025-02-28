<?php

namespace App\Controllers;
use App\Models\RegisterModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_meteran = $this->generateUniqueID($db);

        return view('auth/register', ['id_meteran' => $id_meteran]);
    }

    public function save()
    {
        $userModel = new UserModel(); 
        $registerModel = new RegisterModel(); 
        $db = \Config\Database::connect();

        
        $userData = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'roles_id' => 3,
        ];
        $registerModel->insert($userData);
        $userId = $registerModel->insertID();

        $penggunaData = [
            'id_meteran' => $this->generateUniqueID($db),
            'users_id' => $userId,
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_meteran' => 'belum aktif'
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/', $newName);
            $penggunaData['foto'] = $newName; 
        } else {
            $penggunaData['foto'] = null; 
        }

        $userModel->insert($penggunaData);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil!');
    }


    private function generateUniqueID($db)
    {
        do {
            $timestamp = date("Ymd");
            $randomNumber = mt_rand(1000, 9999);
            $id_meteran = $timestamp . $randomNumber;

            $query = $db->query("SELECT COUNT(*) as count FROM pengguna WHERE id_meteran = ?", [$id_meteran]);
            $result = $query->getRow();
        } while ($result->count > 0);

        return $id_meteran;
    }
}
