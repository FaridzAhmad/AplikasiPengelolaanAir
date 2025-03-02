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
    return $this->select('pengguna.*, users.email') // Pilih kolom yang ingin diambil
                ->join('users', 'users.id = pengguna.users_id') // Join ke tabel users
                ->where('pengguna.users_id', $userId) // Filter berdasarkan users_id
                ->first(); // Ambil satu data
}


}
