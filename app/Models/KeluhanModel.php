<?php
namespace App\Models;

use CodeIgniter\Model;

class KeluhanModel extends Model
{
    protected $table = 'keluhan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'keluhan', 'teknisi', 'status','foto', 'created_at','foto_teknisi'];

    public function getAllKeluhan()
    {
        return $this->select('keluhan.*, teknisi.nama, pengguna.nama, pengguna.alamat, pengguna.no_hp')
                    ->join('teknisi', 'teknisi.users_id = keluhan.teknisi', 'left')
                    ->join('pengguna', 'keluhan.id_meteran = pengguna.id_meteran')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getKeluhanById($id)
    {
        return $this->select('keluhan.*, 
                            teknisi.users_id,
                            pengguna.nama as nama_pengguna, 
                            pengguna.alamat,
                            pengguna.no_hp')
                    ->join('teknisi', 'teknisi.users_id = keluhan.teknisi', 'left')
                    ->join('pengguna', 'pengguna.id_meteran = keluhan.id_meteran', 'left')
                    ->where('keluhan.id', $id)
                    ->first();
    }
}
