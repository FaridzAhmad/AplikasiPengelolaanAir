<?php

namespace App\Models;

use CodeIgniter\Model;

class PemutusanModel extends Model
{
    protected $table = 'pemutusan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'alasan', 'created_at', 'status'];
    protected $createdField  = 'created_at';

    public function getPemutusan()
    {
        return $this->select('pemutusan.*, pengguna.nama, pengguna.nik, pengguna.rt, pengguna.rw, pengguna.alamat')
                    ->join('pengguna', 'pengguna.id_meteran = pemutusan.id_meteran')
                    ->where('pemutusan.status =','pending')
                    ->findAll();
    }

}
