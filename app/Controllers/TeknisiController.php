<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TeknisiModel;
use App\Models\PengumumanModel;
use App\Models\KeluhanModel;

class TeknisiController extends BaseController
{
    public function index()
    {
        // $teknisiModel = new TeknisiModel();
        // $data['teknisi'] = $teknisiModel->getTeknisiname(); 
        // dd(session()->get());

        return view('teknisi/dashboard');
    }
    public function pengumuman()
    {
        $pengumumanModel = new PengumumanModel();
        
        $data['pengumuman'] = $pengumumanModel
            ->like('target', 'teknisi')
            ->findAll();

        return view('teknisi/pengumuman', $data);
    }

    public function keluhan()
    {
        $pengumumanModel = new KeluhanModel();
        
        $data['keluhan'] = $pengumumanModel->getAllKeluhan();

        return view('teknisi/keluhan', $data);
    }

    public function profile()
    {
        $teknisiId =session()->get('user_id');
        $teknisiModel  = new TeknisiModel();
        $data['profile'] = $teknisiModel->where('users_id',$teknisiId)->first();
        // dd($data['profile']);
        return view('teknisi/profile',$data);
    }
    public function uploadFotoKeluhan()
    {
        $keluhanModel = new KeluhanModel();
        $keluhanId = $this->request->getPost('keluhan_id');
        $file = $this->request->getFile('foto');

        // dd($keluhanId);
        // Validasi file
        if (!$file || $file->getError() == 4) {
            return redirect()->back()->with('error', 'Foto wajib diupload.');
        }

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload foto.');
        }

        $newName = $file->getRandomName();
        $file->move('uploads/bukti/', $newName);

        // dd($newName);
        $keluhanModel->update($keluhanId, ['foto_teknisi' => $newName, 'status' => 'selesai']);

        return redirect()->to('/teknisi/keluhan')->with('success', 'Foto berhasil diupload.');
    }

    public function updateProfil()
    {
        $teknisiModel = new TeknisiModel;
        $usersId = $this->request->getPost('users_id');

        $nama   = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_hp  = $this->request->getPost('no_hp');

        $dataUpdate = [
            'nama'   => $nama,
            'alamat' => $alamat,
            'no_hp'  => $no_hp,
        ];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/teknisi', $newName);

            $profil = $teknisiModel->find($usersId);
            if (!empty($profil['foto']) && file_exists('uploads/teknisi/' . $profil['foto'])) {
                unlink('uploads/teknisi/' . $profil['foto']);
            }

            $dataUpdate['foto'] = $newName;
        }
        // dd([
        //     'user_id' => $usersId,
        //     'data'    => $dataUpdate
        // ]);
        $teknisiModel->set($dataUpdate)
             ->where('users_id', $usersId)
             ->update();

        return redirect()->to('/teknisi/profile')->with('success', 'Profil berhasil diperbarui.');
    }   

}
