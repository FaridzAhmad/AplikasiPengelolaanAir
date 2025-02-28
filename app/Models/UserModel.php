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


}
