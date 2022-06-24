<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\MenuAdmModel;
use App\Models\ContactCompanyModel;


class Contact extends BaseController
{
    private $contactModel;
    private $menuModel;
    
    public function __construct()
    {
        $this->session   = session();
        $this->contactModel = new ContactCompanyModel(); 
        $this->menuModel = new MenuAdmModel();
    }
    
    public function index()
    {
        $data = [
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Contato empresa',
            'description' => 'Cadastro Edição e Exclusão',
            'contacts'    => $this->contactModel->findAll()
        ];
        
        echo view('admin/pages/users/usuarios',$data);
    }
    
    //store no form-update
    public function store()
    {
        if($this->request->getMethod() === 'post'){
            
                $data = [
                    'id'         => $this->request->getPost('id'),
                    'contact'    => $this->request->getPost('contact'),
                    'email'      => $this->request->getPost('email'),
                    'telephone'  => $this->request->getPost('telephone'),
                    'mobile'     => $this->request->getPost('mobile'),
                    'user_id'    => session()->get('id'),
                    'company_id' => $this->request->getPost('company_id'),
                ];
                
                //dd($data);

                if($this->contactModel->save($data)){
                   $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')));
                }else{
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')))
                            ->with('errors_validation_model_user',$this->contactModel->errors())->withInput();
                }
            }else{
              return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                ->with('errors_validation_model_user',$this->contactModel->errors())->withInput();

        }
    }
    
    public function delete($id = null, $company_id = null)
    {
        if($this->contactModel->delete($id)){
            $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Deletado com sucesso</div>");
            return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' .$company_id));
        }
    }
}