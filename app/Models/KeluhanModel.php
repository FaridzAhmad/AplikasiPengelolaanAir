<?php
namespace App\Models;

use CodeIgniter\Model;

class KeluhanModel extends Model
{
    protected $table = 'keluhan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'keluhan', 'petugas', 'status','foto', 'created_at'];

    public function getAllKeluhan()
    {
        return $this->select('keluhan.*, petugas.nama as nama_petugas')
                    ->join('petugas', 'petugas.id = keluhan.petugas', 'left')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getKeluhanById($id)
    {
        return $this->select('keluhan.*, 
                            petugas.nama as nama_petugas, 
                            pengguna.nama as nama_pengguna, 
                            pengguna.alamat,
                            pengguna.no_hp')
                    ->join('petugas', 'petugas.id = keluhan.petugas', 'left')
                    ->join('pengguna', 'pengguna.id_meteran = keluhan.id_meteran', 'left')
                    ->where('keluhan.id', $id)
                    ->first();
    }
}
