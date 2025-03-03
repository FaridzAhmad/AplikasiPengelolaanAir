<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PemutusanModel;
use App\Models\KeluhanModel;

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
        return view('user/dashboard');
    }

    public function putusSambungan()
    {
        $penggunaModel = new UserModel(); 
        $pemutusanModel = new PemutusanModel();
        $userId = session()->get('user_id'); 

        $pengguna = $penggunaModel->getDataPengguna($userId); 

        if (!$pengguna) {
            return redirect()->to('/user/dashboard')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $pengajuan = $pemutusanModel->where('id_meteran', $pengguna['id_meteran'])->first();

        if ($pengajuan) {
            if ($pengajuan['status'] === 'pending') {
                $pesan = 'Pengajuanmu sedang diproses.';
            } elseif ($pengajuan['status'] === 'disetujui') {
                $pesan = 'Pengajuanmu telah disetujui. Sambungan telah diputus.';
            }
        }
        
        return view('user/putus_sambungan', [
            'pengguna' => $pengguna,
            'pengajuan' => $pengajuan ?? null,
            'pesan' => $pesan ?? null
        ]);
        
    }


    public function ajukanPemutusan()
    {
        $pemutusanModel = new PemutusanModel(); 

        $id_meteran = $this->request->getPost('id_meteran');
        $alasan = $this->request->getPost('alasan');

        // dd($id_meteran, $alasan);

        if ($id_meteran && $alasan) {
            $pemutusanModel->insert([
                'id_meteran' => $id_meteran,
                'alasan'     => $alasan,
            ]);

            return redirect()->to('/user/dashboard')->with('success', 'Pengajuan pemutusan berhasil dikirim.');
        }

        return redirect()->to('/user/dashboard')->with('error', 'Gagal mengajukan pemutusan.');
    }


    public function formKeluhan()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id'); 

        $pengguna = $userModel->where('users_id', $userId)->first(); 

        if (!$pengguna) {
            return redirect()->to('/user/dashboard')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('user/keluhan', ['pengguna' => $pengguna]);
    }

    public function simpanKeluhan()
    {
        $keluhanModel = new KeluhanModel();
        $userId = session()->get('user_id'); 

        date_default_timezone_set('Asia/Jakarta');

        $lastKeluhan = $keluhanModel->where('users_id', $userId)
                                    ->orderBy('created_at', 'DESC')
                                    ->first();

        if ($lastKeluhan) {
            $lastCreatedAt = strtotime($lastKeluhan['created_at']);
            $currentTime = time();

            if (($currentTime - $lastCreatedAt) < 86400) { 
                return redirect()->back()->with('error', 'Anda hanya dapat mengirim keluhan sekali dalam 24 jam.');
            }
        }

        $file = $this->request->getFile('foto');

        if (!$file || $file->getError() == 4) {
            return redirect()->back()->with('error', 'Foto keluhan wajib diupload.');
        }

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload foto.');
        }
        $newName = $file->getRandomName();
        $file->move('uploads/keluhan/', $newName);

        $data = [
            'users_id' => $userId,
            'id_meteran' => $this->request->getPost('id_meteran'),
            'keluhan' => $this->request->getPost('keluhan'),
            'foto' => $newName,
            'status' => 'review',
            'created_at' => date('Y-m-d H:i:s') 
        ];

        $keluhanModel->insert($data);

        return redirect()->to('/user/keluhan')->with('success', 'Keluhan berhasil dikirim.');
    }


}



