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
}
