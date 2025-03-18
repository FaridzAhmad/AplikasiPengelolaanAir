<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'pengguna'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'users_id', 'nik', 'nama', 'rt', 'rw', 'alamat', 'no_hp', 'foto','status_meteran'];

    public function getBelumAktif()
    {
        return $this->where('status_meteran', 'belum aktif')
                    ->findAll();
    }

    public function getAktif()
    {
        return $this->where('status_meteran', 'aktif')
                    ->findAll();
    }
    public function getDataPengguna($userId)
    {
        return $this->select('pengguna.*, users.email') 
                    ->join('users', 'users.id = pengguna.users_id') 
                    ->where('pengguna.users_id', $userId) 
                    ->first(); 
    }
    
    public function getDataPenggunaAll($userId)
    {
        return $this->select('
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
    }

}
