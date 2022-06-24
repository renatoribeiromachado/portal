<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MenuAdmModel;

class Usuarios extends BaseController
{
    private $userModel;
    private $menuModel;
    
    public function __construct()
    {
        $this->session   = session();
        $this->userModel = new UserModel(); 
        $this->menuModel = new MenuAdmModel();
    }
    
    public function index()
    {
        $data = [
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Lista de usuários',
            'description' => 'Cadastro Edição e Exclusão',
            'users'       => $this->userModel->orderby('name','desc')->paginate(50),
            'pager'       => $this->userModel->pager,
            'count'       => $this->userModel->countAll(),
        ];
        
        echo view('admin/pages/users/usuarios',$data);
    }
    
    //store no form
    public function store()
    {
        if($this->request->getMethod() === 'post'){
            $img = $this->request->getFile('img');

            //caso a imagem não seja inserida salva só os dados
            if(!$img->isValid()){
                $data = [
                    'id'         => $this->request->getPost('id'),
                    'name'       => $this->request->getPost('name'),
                    'email'      => $this->request->getPost('email'),
                    'password'   => md5($this->request->getVar('password')),
                    'level'      => $this->request->getPost('level'),
                    'status'     => $this->request->getPost('status'),
                    'user_id'    => session()->get('id'),
                    'company_id' => $this->request->getPost('company_id'),
                ];
                
                //dd($data);

                if($this->userModel->save($data)){
                   $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')));
                }else{
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')))
                            ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
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
                        'id'         => $this->request->getPost('id'),
                        'name'       => $this->request->getPost('name'),
                        'email'      => $this->request->getPost('email'),
                        'password'   => md5($this->request->getPost('password')),
                        'img'        => $newName,
                        'status'     => $this->request->getPost('status')
                    ];

                    if($this->userModel->save($data)){
                        $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                        return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                 ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
                    }else{
                        $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Erro ao cadastrar: prováveis causas, usuário/e-mail, existente</div>");
                        return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
                    }
                }
            } 
        }else{
              return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                ->with('errors_validation_model_user',$this->userModel->errors())->withInput();

        }
    }
    
    //store no form-update
    public function storeUpdate()
    {
        if($this->request->getMethod() === 'post'){
            $img = $this->request->getFile('img');

            //caso a imagem não seja inserida salva só os dados
            if(!$img->isValid()){
                $data = [
                    'id'         => $this->request->getPost('id'),
                    'name'       => $this->request->getPost('name'),
                    'email'      => $this->request->getPost('email'),
                    'level'      => $this->request->getPost('level'),
                    'status'     => $this->request->getPost('status'),
                    'user_id'    => session()->get('id'),
                    'company_id' => $this->request->getPost('company_id'),
                ];
                
                //dd($data);

                if($this->userModel->save($data)){
                   $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')));
                }else{
                    return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' . $this->request->getPost('company_id')))
                            ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
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
                        'id'         => $this->request->getPost('id'),
                        'name'       => $this->request->getPost('name'),
                        'email'      => $this->request->getPost('email'),
                        'img'        => $newName,
                        'status'     => $this->request->getPost('status')
                    ];

                    if($this->userModel->save($data)){
                        $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                        return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                 ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
                    }else{
                        $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Erro ao cadastrar: prováveis causas, usuário/e-mail, existente</div>");
                        return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                ->with('errors_validation_model_user',$this->userModel->errors())->withInput();
                    }
                }
            } 
        }else{
              return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/'. $this->request->getPost('company_id')))
                                ->with('errors_validation_model_user',$this->userModel->errors())->withInput();

        }
    }
    
    /** Enviar email**/
    public function sendEmail()
    {
        
        dd("Aqui enviando email");
        if ($this->request->getMethod() === 'post')
        {
            $name = $this->request->getVar('name');
            $emailFrom = $this->request->getVar('email');
            $subject = $this->request->getVar('subject');
            $mensage = $this->request->getVar('mensage');

            $email = \Config\Services::email();
            $email->setFrom($emailFrom, $name);
            $email->setTo('renato@markp.com.br');
            //$email->setCC('another@another-example.com');
            //$email->setBCC('them@their-example.com');

            $email->setSubject($subject);
            $email->setMessage("Nome: " . $name . "\nAssunto: " . $subject . "\nE-mail: " . $emailFrom . "\nMensagem: " . $mensage);

            $email->send();

            if ($email->send(false))
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger"> <i class="fa fa-thumbs-down"></i> Erro ao tentar enviar mensagem</div>');
                //$this->contact();
            }
            else
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-success"> <i class="fa fa-thumbs-up"></i> Mensagem enviada com sucesso</div>');
                //$this->contact();
            }
        }
    }
    
    public function delete($id = null, $company_id = null)
    {
        if($this->userModel->delete($id)){
            $this->session->setFlashdata('msg',"<div class='alert alert-danger'> Deletado com sucesso</div>");
            return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' .$company_id));
        }
    }
}