<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['users_id', 'nama', 'rt', 'rw', 'desa_id', 'kecamatan_id', 'no_hp', 'foto'];


}
