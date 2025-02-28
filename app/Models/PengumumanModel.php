<?php
namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'isi', 'target', 'created_at'];

    public function getPengumumanByTarget($target)
    {
        return $this->where('target', $target)
                    ->orWhere('target', 'semua')
                    ->findAll();
    }
}
