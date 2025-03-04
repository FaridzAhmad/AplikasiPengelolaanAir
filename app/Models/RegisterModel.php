<?php

namespace App\Models;
use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','email', 'password', 'roles_id'];
}
