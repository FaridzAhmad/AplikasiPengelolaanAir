<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'pengguna'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['users_id', 'nama', 'rt', 'rw', 'desa_id', 'kecamatan_id', 'no_hp', 'foto'];

    public function getUserName()
    {
        return $this->db->table('pengguna')
            ->select('pengguna.*,users.email') 
            ->join('users', 'users.id = pengguna.users_id')
            ->get()
            ->getRowArray(); 
    }
}
