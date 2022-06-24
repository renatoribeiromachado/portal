<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\MenuAdmModel;
use App\Models\BriefingModel;

class Project extends BaseController
{
    private $projectModel;
    private $menuModel;
    
    public function __construct()
    {
        $this->session       = session();
        $this->projectModel  = new ProjectModel(); 
        $this->briefingModel = new BriefingModel();
        $this->menuModel     = new MenuAdmModel();
    }
    
    public function create()
    {
        $data = [
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Cadastro de projetos',
            'description' => 'Cadastro Edição e Exclusão',
            'projects'    => $this->projectModel->orderby('title','desc')->findAll(),
            'briefings'   => $this->briefingModel->orderby('id','asc')->findAll(),
            'count'       => $this->projectModel->countAll(),
        ];
        
        echo view('admin/pages/project/form',$data);
    }
    
    //store no form
    public function store()
    {
        if($this->request->getMethod() === 'post'){
            $img = $this->request->getFile('img');

            //caso a imagem não seja inserida salva só os dados
            if(!$img->isValid()){
                $data = [
                    'id'          => $this->request->getPost('id'),
                    'title'       => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'status'      => $this->request->getPost('status'),
                    'user_id'     => session()->get('id'),
                    'company_id'  => session()->get('company_id'),
                ];
                
                //dd($data);

                if($this->projectModel->save($data)){
                   $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                    return redirect()->to(base_url('pt-BR/boards/tasks/'));
                }else{
                    return redirect()->to(base_url('pt-BR/boards/project/cadastro-projeto/'))
                            ->with('errors_validation_model_project',$this->projectModel->errors())->withInput();
                }
            }else{
                //faz a validação da imagem para salvar no BD
                $validateIMG = $this->validate([
                    'img' =>[
                        'uploaded[img]',
                        'mime_in[img,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[img,4096]',
                    ],
                ]);

                if($validateIMG){
                    $newName = $img->getRandomName();
                    $img->move('public/img/users', $newName);
                    $data = [
                        'id'          => $this->request->getPost('id'),
                        'title'       => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'status'      => $this->request->getPost('status'),
                        'user_id'     => session()->get('id'),
                        'company_id'  => session()->get('company_id'),
                        'img'         => $newName
                    ];

                    if($this->projectModel->save($data)){
                        $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                        return redirect()->to(base_url('pt-BR/boards/tasks/'))
                                 ->with('errors_validation_model_user',$this->projectModel->errors())->withInput();
                    }else{
                        $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Erro ao cadastrar: prováveis causas, usuário/e-mail, existente</div>");
                        return redirect()->to(base_url('pt-BR/boards/project/cadastro-projeto/'))
                                ->with('errors_validation_model_user',$this->projectModel->errors())->withInput();
                    }
                }
            } 
        }else{
              return redirect()->to(base_url('pt-BR/boards/project/cadastro-projeto/'))
                                ->with('errors_validation_model_project',$this->projectModel->errors())->withInput();

        }
    }
    
    public function delete($id = null, $company_id = null)
    {
        if($this->projectModel->delete($id)){
            $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Deletado com sucesso</div>");
            return redirect()->to(base_url('pt-BR/boards/project/cadastro-projeto/' .$company_id));
        }
    }
}