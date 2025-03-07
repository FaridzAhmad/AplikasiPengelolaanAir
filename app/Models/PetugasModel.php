<?php
namespace App\Models;
use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['users_id', 'nama', 'alamat', 'no_hp', 'foto', 'jobdesk'];

    // public function getPetugasName()
    // {
    //     return $this->db->table('petugas')
    //         ->select('petugas.*,users.email') 
    //         ->join('users', 'users.id = petugas.users_id')
    //         ->get()
    //         ->getRowArray(); 
    // }
    public function getPetugasById($id)
    {
        return $this->where('users_id', $id)->first();
    }

    public function simpanPetugas($data)
    {
        return $this->insert($data);
    }
}
