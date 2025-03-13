<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;
use App\Models\SurveyAwalModel;
use App\Models\UserModel;

class PetugasController extends Controller
{
    public function index()
    {
        // $petugasModel = new PetugasModel();
        // $data['petugas'] = $petugasModel->getPetugasname(); 

        return view('petugas/dashboard');
    }

    public function sambunganBaru()
    {
        $surveyModel = new SurveyAwalModel();
        
        $petugasId = session()->get('user_id');

        $surveys = $surveyModel->getSurveyByPetugas($petugasId);

        // dd(session()->get());
        return view('petugas/sambungan_baru', ['surveys' => $surveys]);
    }

    public function hasilSurvey($id_meteran)
    {
        $surveyModel = new SurveyAwalModel();
        $penggunaModel = new UserModel();

        $survey = $surveyModel->where('id_meteran', $id_meteran)->first();

        $pengguna = $penggunaModel->where('id_meteran', $id_meteran)->first();

        if (!$survey || !$pengguna) {
            return redirect()->to('/petugas/sambunganBaru')->with('error', 'Data tidak ditemukan!');
        }

        return view('petugas/hasil_survey', [
            'survey' => $survey,
            'pengguna' => $pengguna
        ]);
    }


    public function uploadHasilSurvey()
    {
        $surveyModel = new SurveyAwalModel();
        $request = $this->request;
    
        // Validasi input
        if (!$this->validate([
            'foto_survey' => [
                'rules' => 'uploaded[foto_survey]|is_image[foto_survey]|max_size[foto_survey,2048]|mime_in[foto_survey,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal foto 2MB.',
                    'mime_in' => 'Format yang diperbolehkan hanya JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
    
        $id_meteran = $request->getPost('id_meteran');
    
        // dd(['id_meteran' => $id_meteran]);
    
        $existingSurvey = $surveyModel->where('id_meteran', $id_meteran)->first();
        if (!$existingSurvey) {
            dd("ID Meteran tidak ditemukan di database!");
        }
    
        $foto = $request->getFile('foto_survey');
    
        if (!$foto->isValid()) {
            dd("File upload gagal: " . $foto->getErrorString());
        }
    
        $newFileName = $id_meteran . '_' . time() . '.' . $foto->getExtension();
    
        if (!$foto->move('uploads/survey/', $newFileName)) {
            dd("Gagal memindahkan file ke folder uploads.");
        }
    
        // dd(['file_path' => 'uploads/survey/' . $newFileName]);
    
        $result = $surveyModel->where('id_meteran', $id_meteran)->set([
            'foto' => 'uploads/survey/' . $newFileName,
            'status' => 'sudah disurvey',
            'tanggal_survey' => date('Y-m-d')
        ])->update();

        // dd($result); // True jika berhasil, False jika gagal
    
        return redirect()->to('/petugas/sambungan-baru')->with('success', 'Hasil survey berhasil disimpan!');
    }
    
    public function dataMeteran()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->where('status_meteran', 'aktif')->findAll();

        return view('petugas/data_meteran', $data);
    }
}
