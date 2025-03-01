<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\PengumumanModel;

class AdminController extends Controller
{
    protected $admins;

    // public function __construct()
    // {
    //     $this->admins = [];
    // }
    protected $penggunaModel;
    protected $pengumumanModel;

    public function __construct()
    {
        $this->penggunaModel = new \App\Models\UserModel();
        $this->pengumumanModel = new PengumumanModel();
    }


    public function index()
    {
        // $session = session();
        // $adminModel = new AdminModel();

        // 
        // $adminId = $session->get('user_id'); 

        // 
        // if (!$adminId) {
        //     return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        // }

        // 
        // $this->admins = $adminModel->getAdminName($adminId);

        // // Kirim data ke view dashboard
        return view('admin/dashboard', ['admins' => $this->admins]);
    }

    public function customer()
    {
        $pengguna = $this->penggunaModel->getAktif(); 

        return view('admin/customer', [
            'penggunas' => $pengguna
        ]);
    }

    public function updateStatus()
    {
        $penggunaModel = new UserModel(); 
        $id = $this->request->getPost('id_meteran');
        $status = $this->request->getPost('status_meteran');
    
        if ($id && $status) {
            $penggunaModel->update($id, ['status_meteran' => $status]);
            return redirect()->to('/admin/customer')->with('success', 'Status berhasil diperbarui.');
        }
    
        return redirect()->to('/admin/customer')->with('error', 'Gagal memperbarui status.');
    }
    
    public function belumAktif()
    {
        $penggunaModel = new UserModel();
        $data['users'] = $penggunaModel->getBelumAktif();

        return view('admin/sambungan_baru', $data);

    }

    public function pengumuman()
    {
        $data['pengumumans'] = $this->pengumumanModel->findAll();
        return view('admin/pengumuman', $data);
    }

    public function tambahPengumuman()
    {
        return view('admin/tambah_pengumuman');
    }

    public function simpanPengumuman()
    {
        $this->pengumumanModel->save([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'target' => $this->request->getPost('target') ? implode(',', $this->request->getPost('target')) : 'pengguna,petugas',
            'awal_berlaku' => date('Y-m-d', strtotime(str_replace('-', '/', $this->request->getPost('awal_berlaku')))),
            'akhir_berlaku' => date('Y-m-d', strtotime(str_replace('-', '/', $this->request->getPost('akhir_berlaku'))))
        ]);

        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman berhasil dibuat!');
    }

}
