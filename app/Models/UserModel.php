<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'img', 'company_id', 'level', 'status','user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    /*Validação*/
    protected $validationRules = [
        'name'     => 'required|min_length[6]|max_length[120]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]',
    ];
    
    /*mensagem da validação*/
    protected $validationMessages = [
        'name' => [
            'required' => 'O campo usuário é obrigatório'
        ],
        'email' => [
            'required' => 'O campo login é obrigatório',
            'is_unique' => 'Desculpa, login existente.',
        ],
        'password' => [
            'required' => 'O campo password é obrigatório',
        ],
    ];

    public function getUser($email, $password)
    {          
        return $this->asArray()
                        ->where(['email' => $email, 'password' => $password, 'status' => 1])
                        ->first();
    }

}