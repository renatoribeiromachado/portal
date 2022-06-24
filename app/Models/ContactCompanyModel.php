<?php

namespace App\Models;
use CodeIgniter\Model;

class ContactCompanyModel extends Model
{
    protected $table           = 'contact_company';
    protected $primaryKey      = 'id';
    //protected $returnType      = 'array';
    //protected $useSoftDeletes  = true;
    protected $allowedFields   = ['contact','company_id','email','telephone','mobile','user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    /*Validação*/
    protected $validationRules = [
        'contact'   => 'required|min_length[6]|max_length[150]|is_unique[contact_company.contact,id,{id}]',
        'email'     => 'required|valid_email|is_unique[contact_company.email,id,{id}]',
        'telephone' => 'required|min_length[13]',
        'mobile'    => 'required|min_length[14]|is_unique[contact_company.mobile,id,{id}]'
    ];
    
    /*mensagem da validação*/
    protected $validationMessages = [
        'contact' => [
            'required' => 'O campo Contato é obrigatório',
            'is_unique' => 'Desculpa, contato existente.',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório',
            'is_unique' => 'Desculpa, e-mail existente.',
        ],
        'telephone' => [
            'required' => 'O campo Telefone é obrigatório'
        ],
        'mobile' => [
            'required' => 'O campo Celular é obrigatório',
            'is_unique' => 'Desculpa, celular existente.',
        ],
    ];
    
}