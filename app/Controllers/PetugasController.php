<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;
use App\Models\SurveyAwalModel;
use App\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\InvoiceModel;
use App\Models\PengumumanModel;


class PetugasController extends BaseController
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
    
        $id_meteran = $request->getPost('id_meteran');
        if (!$id_meteran) {
            dd("Error: ID Meteran tidak ditemukan dalam request.");
        }
    
        $existingSurvey = $surveyModel->where('id_meteran', $id_meteran)->first();
        if (!$existingSurvey) {
            dd("Error: ID Meteran tidak ditemukan di database!");
        }
    
        if (!$this->validate([
            'foto_survey' => [
                'rules' => 'uploaded[foto_survey]|is_image[foto_survey]|mime_in[foto_survey,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal foto 2MB.',
                    'mime_in' => 'Format yang diperbolehkan hanya JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            dd("Validasi gagal:", $this->validator->getErrors());
        }
    
        $foto = $request->getFile('foto_survey');
        if (!$foto->isValid()) {
            dd("Error: File upload gagal. " . $foto->getErrorString());
        }
    
        $uploadPath = 'uploads/survey/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $newFileName = $id_meteran . '_' . time() . '.' . $foto->getExtension();
    
        if (!$foto->move($uploadPath, $newFileName)) {
            dd("Error: Gagal memindahkan file ke folder uploads.");
        }
    
        $filePath = $uploadPath . $newFileName;
    
        $updateResult = $surveyModel->where('id_meteran', $id_meteran)->set([
            'foto' => $filePath,
            'status' => 'sudah disurvey',
            'tanggal_survey' => date('Y-m-d')
        ])->update();
    
        if (!$updateResult) {
            dd("Error: Gagal mengupdate database.");
        }
    
        // dd("Sukses! Data berhasil disimpan.", [
        //     'id_meteran' => $id_meteran,
        //     'file_path' => $filePath,
        //     'status' => 'sudah disurvey',
        //     'tanggal_survey' => date('Y-m-d')
        // ]);
    
        return redirect()->to('/petugas/sambungan-baru')->with('success', 'Hasil survey berhasil disimpan!');
    }
    
    
    public function dataMeteran()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->where('status_meteran', 'aktif')->findAll();

        return view('petugas/data_meteran', $data);
    }

    public function inputMeteran($id_meteran)
    {
        $penggunaModel = new UserModel();
        $transaksiModel = new TransaksiModel();

        $pengguna = $penggunaModel->where('id_meteran', $id_meteran)->first();
        if (!$pengguna) {
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        }

        $transaksiTerbaru = $transaksiModel->where('id_meteran', $id_meteran)
            ->orderBy('created_at', 'DESC')
            ->first();

        $data = [
            'pengguna' => $pengguna,
            'transaksiTerbaru' => $transaksiTerbaru
        ];

        return view('petugas/input_meteran', $data);
    }

    public function simpanMeteran($id_meteran)
{
    $transaksiModel = new TransaksiModel();
    $invoiceModel = new InvoiceModel(); 

    $meteranAwal = $this->request->getPost('meteran_awal');
    $meteranAkhir = $this->request->getPost('meteran_akhir');
    $jumlahPakai = $meteranAkhir - $meteranAwal;
    $jumlahTagihan = $jumlahPakai * 100000;

    $bulan = date('m') + 1; 
    $tahun = date('Y');

    if ($bulan > 12) { 
        $bulan = 1; 
        $tahun += 1; 
    }

    $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT); 

    $invoice = "INVOICE-{$id_meteran}-{$bulan}{$tahun}";

    $batasWaktu = date("Y-m-20", strtotime("+1 month")); 

    // dd([
    //     'STEP' => 'SEBELUM INSERT TRANSAKSI',
    //     'id_meteran' => $id_meteran,
    //     'meteran_awal' => $meteranAwal,
    //     'meteran_akhir' => $meteranAkhir,
    //     'jumlah_pakai' => $jumlahPakai,
    //     'jumlah_tagihan' => $jumlahTagihan,
    //     'invoice' => $invoice,
    //     'periode_bulan' => $bulan,
    //     'periode_tahun' => $tahun
    // ]);

    // ✅ Simpan ke tabel transaksi
    $transaksiModel->insert([
        'id_meteran' => $id_meteran,
        'meteran_awal' => $meteranAwal,
        'meteran_akhir' => $meteranAkhir,
        'jumlah_pakai' => $jumlahPakai,
        'jumlah_tagihan' => $jumlahTagihan,
        'invoice' => $invoice,
        'periode_bulan' => $bulan,
        'periode_tahun' => $tahun,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    // dd([
    //     'STEP' => 'SESUDAH INSERT TRANSAKSI',
    //     'LAST_INSERT_ID' => $transaksiModel->insertID()
    // ]);

    // ✅ Simpan ke tabel invoice
    $invoiceModel->insert([
        'invoice' => $invoice,
        'jumlah_tagihan' => $jumlahTagihan,
        'status_bayar' => 'Belum Lunas',
        'tanggal_pembayaran' => null,
        'bukti_bayar' => null,
        'batas_waktu_bayar' => $batasWaktu,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    // dd([
    //     'STEP' => 'SESUDAH INSERT INVOICE',
    //     'LAST_INSERT_ID' => $invoiceModel->insertID()
    // ]);

    return redirect()->to('/petugas/data-meteran')->with('success', 'Input data meteran berhasil disimpan.');
}
public function pengumuman()
    {
        $pengumumanModel = new PengumumanModel();
        
        $data['pengumuman'] = $pengumumanModel
            ->like('target', 'petugas')
            ->findAll();

        return view('petugas/pengumuman', $data);
    }

}
