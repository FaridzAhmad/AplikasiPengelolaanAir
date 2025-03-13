<?php

namespace App\Controllers;
use App\Models\RegisterModel;
use App\Models\UserModel;
use App\Models\TransaksiAwalModel;
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
        $transaksiModel = new TransaksiAwalModel(); 
        $db = \Config\Database::connect();

        $nik = $this->request->getPost('nik');
        $existingUser = $userModel->where('nik', $nik)->first();

        if ($existingUser) {
            return redirect()->back()->with('error', 'NIK sudah terdaftar!')->withInput();
        }

        $db->query('SET FOREIGN_KEY_CHECKS = 0;');

        $tahun = date('Y');

        $lastUser = $registerModel
            ->select('id')
            ->where('roles_id', 3)
            ->like('id', "PENGGUNA-$tahun-", 'after')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastUser) {
            $lastNumber = (int) substr($lastUser['id'], -4); 
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); 
        } else {
            $newNumber = '0001'; 
        }

        $newUserId = "PENGGUNA-$tahun-$newNumber";

        $userData = [
            'id' => $newUserId,
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'roles_id' => 3,
        ];
        $registerModel->insert($userData); 

        $id_meteran = $this->generateUniqueID($db);

        $penggunaData = [
            'id_meteran' => $id_meteran,
            'users_id' => $newUserId, 
            'nik' => $nik,
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

        $transaksiData = [
            'id_meteran' => $id_meteran,
            'status_bayar' => 'belum bayar',
            'bukti_bayar' => null,
            'tanggal_pembayaran' => null,
            'nominal' => 500000, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $transaksiModel->insert($transaksiData);

        $db->query('SET FOREIGN_KEY_CHECKS = 1;');

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
