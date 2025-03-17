<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PemutusanModel;
use App\Models\KeluhanModel;
use App\Models\TransaksiAwalModel;


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


        $userId = session('user_id'); 

        $userModel = new UserModel();
        $pengguna = $userModel->select('pengguna.*, users.email')
            ->join('users', 'users.id = pengguna.users_id')
            ->where('users.id', $userId)
            ->first();
    
        if (!$pengguna) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }
    
        $data['pengguna'] = $pengguna;
        // dd($data);
        return view('user/dashboard', $data);
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

    public function konfirmasiPembayaranAwal()
    {
        $transaksiModel = new TransaksiAwalModel();
        $request = $this->request;

        $id_meteran = $request->getPost('id_meteran');

        $transaksi = $transaksiModel->where('id_meteran', $id_meteran)->first();
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }
        $bukti = $request->getFile('bukti_bayar');
        if (!$bukti->isValid() || $bukti->hasMoved()) {
            return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
        }

        $fileName = 'bukti_' . $id_meteran . '_' . time() . '.' . $bukti->getExtension();

        $bukti->move('uploads/bukti_bayar', $fileName);

        $transaksiModel->where('id_meteran', $id_meteran)->set([
            'bukti_bayar' => 'uploads/bukti_bayar/' . $fileName,
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'status_bayar' => 'sudah bayar'
        ])->update();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim.');
    }

    public function tagihanAwal()
    {
        $userId = session('user_id'); 

        $userModel = new UserModel();
        $pengguna = $userModel->select('
                pengguna.*, 
                users.email, 
                transaksi_awal.nominal, 
                transaksi_awal.status_bayar, 
                transaksi_awal.bukti_bayar, 
                transaksi_awal.tanggal_pembayaran, 
                IFNULL(survey_awal.id, FALSE) AS survey, 
                survey_awal.tanggal_survey
            ')
            ->join('users', 'users.id = pengguna.users_id')
            ->join('transaksi_awal', 'transaksi_awal.id_meteran = pengguna.id_meteran', 'left') 
            ->join('survey_awal', 'survey_awal.id_meteran = pengguna.id_meteran', 'left') 
            ->where('users.id', $userId)
            ->first();

        if (!$pengguna) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $pengguna['survey'] = $pengguna['survey'] ? $pengguna['survey'] : false;

        $data['pengguna'] = $pengguna;
        // dd($data); 

        return view('user/tagihan_awal', $data);
    }


}



