<?php
namespace App\Models;
use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['users_id', 'nama', 'rt', 'rw', 'desa_id', 'kecamatan_id','nip', 'no_hp', 'foto'];

    public function getPetugasName()
    {
        return $this->db->table('petugas')
            ->select('petugas.*,users.email') 
            ->join('users', 'users.id = petugas.users_id')
            ->get()
            ->getRowArray(); 
    }
}
