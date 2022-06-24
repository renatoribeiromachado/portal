<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model {

    protected $table         = 'projects';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title', 'description', 'img', 'img', 'status', 'user_id', 'company_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    /*Validação*/
    protected $validationRules = [
        'title'        => 'required',
        'description'  => 'required'
    ];
    
    /*mensagem da validação*/
    protected $validationMessages = [
        'title' => [
            'required' => 'O campo titulo é obrigatório'
        ],
        'description' => [
            'required' => 'O campo descrição é obrigatório',
        ],
    ];
}