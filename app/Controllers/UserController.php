<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PemutusanModel;
use App\Models\KeluhanModel;
use App\Models\TransaksiAwalModel;
use App\Models\InvoiceModel;
use App\Models\PengumumanModel;


class UserController extends BaseController
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
        $penggunaModel = new UserModel();
        $user_id = session()->get('user_id');

        $pengguna = $penggunaModel->where('users_id', $user_id)->first();

        if (!$pengguna || !isset($pengguna['id_meteran'])) {
            return redirect()->back()->with('error', 'Data meteran tidak ditemukan.');
        }

        $id_meteran = $pengguna['id_meteran'];
        // dd($id_meteran);
        date_default_timezone_set('Asia/Jakarta');

        $lastKeluhan = $keluhanModel->where('id_meteran', $id_meteran)
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
            'id_meteran' => $id_meteran,
            'keluhan' => $this->request->getPost('keluhan'),
            'foto' => $newName,
            'status' => 'review',
            'created_at' => date('Y-m-d H:i:s') 
        ];
        // dd($data);
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
        $pengguna = $userModel->getDataPenggunaAll($userId);

        if (!$pengguna) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $pengguna['survey'] = $pengguna['survey'] ? $pengguna['survey'] : false;

        $data['pengguna'] = $pengguna;
        // dd($data); 

        return view('user/tagihan_awal', $data);
    }

    public function tagihan()
    {
        $userId = session('user_id'); 
        
        $tagihanModel = new InvoiceModel();
        $userModel = new UserModel();

        // Ambil data pengguna berdasarkan user_id
        $pengguna = $userModel->getDataPenggunaAll($userId);

        if (!$pengguna) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $id_meteran = $pengguna['id_meteran']; // Jika $pengguna adalah array

        // Ambil data tagihan berdasarkan id_meteran
        $data['pengguna'] = $pengguna;
        $data['tagihan'] = $tagihanModel->getInvoiceDetails($id_meteran);

        // $tagihan = isset($data['tagihan'][1]) ? $data['tagihan'][1] : null;
        // dd($data['tagihan']);
        return view('user/tagihan', $data);

    }

    public function bayarTagihan($invoice)
    {
        $userId = session('user_id'); 
    
        $tagihanModel = new InvoiceModel();
        $userModel = new UserModel();

        $pengguna = $userModel->getDataPenggunaAll($userId);

        $invoiceModel = new InvoiceModel();
        $data['invoice'] = $invoiceModel->where('invoice', $invoice)->first();
        
        // dd($data);
        if (!$data['invoice']) {
            return redirect()->to('user/tagihan')->with('error', 'Tagihan tidak ditemukan.');
        }
        
        $data['pengguna'] = $pengguna;
        return view('user/bayar_tagihan', $data);
    }

    public function prosesPembayaranInvoice()
    {
        $invoiceModel = new InvoiceModel();
        $invoice = $this->request->getPost('invoice'); 
        $file = $this->request->getFile('bukti_bayar');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = 'uploads/bukti_pembayaran';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); 
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $invoiceModel->where('invoice', $invoice)
                ->set([
                    'bukti_bayar' => $newName,
                    'tanggal_pembayaran' => date('Y-m-d H:i:s')
                ])
                ->update();

            return redirect()->to('/user/tagihan')->with('success', 'Bukti pembayaran berhasil dikirim.');
        }

        return redirect()->to('/user/tagihan')->with('error', 'Gagal mengupload bukti pembayaran.');

        }

        public function pengumuman()
        {
            // dd($this->recentAnnouncements);
            $userId = session('user_id'); 
            $userModel = new UserModel();

            $pengguna = $userModel->getDataPenggunaAll($userId);
            $pengumumanModel = new PengumumanModel();
            
            $data['pengguna'] = $pengguna;
            $data['pengumuman'] = $pengumumanModel
                ->like('target', 'pengguna')
                ->findAll();

            return view('user/pengumuman', $data);
        }


}



