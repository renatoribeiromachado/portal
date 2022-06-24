<?php

namespace App\Models;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table          = 'company';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields  = ['company','cnpj','cep','adress','district','city','uf','number','user_id'];
    protected $useTimestamps = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
    
    /*Validação*/
    protected $validationRules = [
        'company'  => 'required|min_length[6]|max_length[150]|is_unique[company.company,id,{id}]',
        'cnpj'     => 'required|min_length[18]|is_unique[company.cnpj,id,{id}]',
        'cep'      => 'required|min_length[9]',
        'adress'   => 'required|min_length[6]|max_length[150]',
        'district' => 'required|min_length[6]|max_length[150]',
        'city'     => 'required|min_length[6]|max_length[150]',
        'uf'       => 'required|min_length[2]',
        'number'   => 'required|min_length[1]|max_length[50]',
    ];
    
    /*mensagem da validação*/
    protected $validationMessages = [
        'company' => [
            'required' => 'O campo Empresa é obrigatório',
             'is_unique' => 'Desculpa, Empresa existente.',
        ],
        'cnpj' => [
            'required' => 'O campo CNPJ é obrigatório',
            'is_unique' => 'Desculpa, CNPJ existente.',
        ],
       'cep' => [
            'required' => 'O campo CEP é obrigatório'
        ],
        'adress' => [
            'required' => 'O campo endereço é obrigatório'
        ],
        'district' => [
            'required' => 'O campo Bairro é obrigatório'
        ],
        'city' => [
            'required' => 'O campo Cidade é obrigatório'
        ],
        'uf' => [
            'required' => 'O campo UF é obrigatório'
        ],
        'number' => [
            'required' => 'O campo número é obrigatório'
        ],
    ];
       
    public function getCompany($id)
    {
       return $this->find($id);
    } 
    
    /**Join contato Users**/ 
    public function getCompanyContactUsers()
    {
        $this->select('cp.id,
                        cp.company,
                        cp.cnpj,
                        cp.created_at,
                        ct.contact,
                        ct.telephone,
                        ct.mobile,
                        u.name,
                        u.email,
                        u.level,
                        u.status'
                    )
            ->from('company cp', true)
            ->join('contact_company ct','ct.company_id = cp.id', 'inner')
            ->join('users u','u.company_id = cp.id', 'inner')
            ->groupby('cp.id');
                //->get() //so se precisar executar lastQuery;
                // dd($this->getLastQuery());
            return $this;
    }
    
    /*search*/
    public function getSearch($search) {

        $this
            ->select('cp.id as company_id,cp.company,cp.created_at,ct.contact,ct.email,ct.mobile')
            ->from('company cp', true)
            ->join('contact_company ct','ct.company_id = cp.id', 'left')
            ->groupby('cp.id')
            ->like('cp.company', $search);
            
            return $this;
    }
}