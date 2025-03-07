<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\PengumumanModel;
use App\Models\PemutusanModel;
use App\Models\keluhanModel;
use App\Models\PetugasModel;
use App\Models\RegisterModel;

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
        $pengguna = $this->penggunaModel->findAll(); 

        return view('admin/customer', [
            'penggunas' => $pengguna
        ]);
    }

    public function updateStatus()
    {
        $penggunaModel = new UserModel(); 
        $id = $this->request->getPost('id'); 
        $status = $this->request->getPost('status_meteran');
    
       
        if (!empty($id) && !empty($status)) {
            $user = $penggunaModel->find($id);
            if ($user) {
                $penggunaModel->update($id, ['status_meteran' => $status]);
                return redirect()->to('/admin/customer')->with('success', 'Status berhasil diperbarui.');
            } else {
                return redirect()->to('/admin/customer')->with('error', 'ID tidak ditemukan.');
            }
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

    public function detail($id)
    {
        $penggunaModel = new UserModel(); 
        $data['pengguna'] = $penggunaModel->where('id_meteran', $id)->first();

        if (!$data['pengguna']) {
            return redirect()->to('/admin/customer')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/detail_pengguna', $data);
    }

    public function putusSambungan()
    {
        $penggunaModel = new UserModel();
        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->to('/admin/customer')->with('error', 'ID tidak ditemukan.');
        }
        
        $update = $penggunaModel->update($id, ['status_meteran' => 'putus']);

        if ($update) {
            return redirect()->to('/admin/customer')->with('success', 'Sambungan berhasil diputus.');
        } else {
            return redirect()->to('/admin/customer')->with('error', 'Gagal memutus sambungan.');
        }
    }

    public function pemutusan()
    {
        $pemutusanModel = new PemutusanModel();
        $data['pemutusans'] = $pemutusanModel->getPemutusan();

        // dd($data);
        return view ('admin/pemutusan', $data);

    }

   public function accPemutusan()
    {
        $pemutusanModel = new PemutusanModel();
        $penggunaModel = new UserModel();

        $id = $this->request->getPost('id'); 
        $idMeteran = $this->request->getPost('id_meteran'); 

        if ($idMeteran) {
            $pemutusanModel->where('id_meteran', $idMeteran)->set(['status' => 'disetujui'])->update();

            $penggunaModel->where('id_meteran', $idMeteran)->set(['status_meteran' => 'putus'])->update();

            return redirect()->to('/admin/pemutusan')->with('success', 'Pemutusan disetujui!');
        }

        return redirect()->to('/admin/pemutusan')->with('error', 'Gagal menyetujui pemutusan.');
    }

    public function listKeluhan()
    {
        $keluhanModel = new KeluhanModel();
        $data['keluhan'] = $keluhanModel->getAllKeluhan(); 
        return view('admin/keluhan', $data);
    }

    public function detailKeluhan($id)
    {
        $keluhanModel = new KeluhanModel();
        $petugasModel = new PetugasModel();

        $data['keluhan'] = $keluhanModel->getKeluhanById($id);
        $data['petugas'] = $petugasModel->findAll(); 
        // dd($data);
        if (!$data['keluhan']) {
            return redirect()->to('/admin/keluhan')->with('error', 'Keluhan tidak ditemukan.');
        }

        return view('admin/detail_keluhan', $data);
    }

    public function updateKeluhan()
    {
        $keluhanModel = new KeluhanModel();

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $petugas = $this->request->getPost('petugas');

        if ($id) {
            $keluhanModel->update($id, [
                'status' => $status,
                'petugas' => $petugas
            ]);

            return redirect()->to('/admin/keluhan')->with('success', 'Status keluhan berhasil diperbarui.');
        }

        return redirect()->to('/admin/keluhan')->with('error', 'Gagal memperbarui keluhan.');
    }

    public function tambahPetugas()
    {
        return view('admin/tambah_petugas'); 
    }

    public function petugas()
    {
        $petugasModel = new PetugasModel();
        $data['petugas'] = $petugasModel->findAll();

        // dd($data);
        return view ('admin/petugas', $data);

    }
    public function detailPetugas($id)
    {
        $petugasModel = new PetugasModel();
        $data['petugas'] = $petugasModel->getPetugasById($id); 
    
        if (empty($data['petugas'])) {
            return redirect()->to('/admin/petugas')->with('error', 'Data Petugas tidak ditemukan.');
        }
        // dd($data);
        return view('admin/detail_petugas', $data);
    }
    
    
    public function simpanPetugas()
    {
        $userModel = new RegisterModel(); 
        $petugasModel = new PetugasModel();
        $db = \Config\Database::connect();

        $db->transStart(); 

        $tahun = date('Y'); 

        $lastPetugas = $petugasModel
            ->select('users_id')
            ->like('users_id', "PETUGAS-$tahun-", 'after')
            ->orderBy('users_id', 'DESC')
            ->first();

        if ($lastPetugas) {
            $lastNumber = (int) substr($lastPetugas['users_id'], -4); 
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $newPetugasId = "PETUGAS-$tahun-$newNumber";

        $userData = [
            'id' => $newPetugasId,
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'roles_id' => 2, 
        ];
        $userModel->insert($userData);

        $foto = $this->request->getFile('foto_petugas');
        $newName = null;
        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/petugas/', $newName);
        }

        $petugasData = [
            'users_id' => $newPetugasId, 
            'nama' => $this->request->getPost('nama_petugas'),
            'alamat' => $this->request->getPost('alamat_petugas'),
            'no_hp' => $this->request->getPost('no_hp_petugas'),
            'foto' => $newName,
        ];
        $petugasModel->insert($petugasData);

        $db->transComplete(); 

        return redirect()->to('/admin/petugas')->with('success', 'Petugas berhasil ditambahkan.');
    }


}
