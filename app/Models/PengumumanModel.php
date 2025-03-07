<?php
namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'isi', 'target', 'created_at', 'awal_berlaku', 'akhir_berlaku'];

    public function getPengumumanByTarget($target)
    {
        return $this->where('target', $target)
                    ->orWhere('target', 'semua')
                    ->findAll();
    }
}
