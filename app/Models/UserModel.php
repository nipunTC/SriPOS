<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'name', 'birthday', 'email', 'user_role','last_login','created_at'];
    protected $returnType = 'array';
}
