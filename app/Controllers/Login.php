<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController {

    public function index()
    {
        $data = [
            'title'       => 'Login painel de Controle',
            'description' => 'Acesso area restrita',
            'msg'         => $this->session->getFlashdata('msg')
        ];

        echo view('admin/pages/login', $data);
    }

    private $userModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel();
    }
    
    /*Logar*/
    public function logar()
    {
        $email    = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        //dd($password);

        $data['users'] = $this->userModel->getUser($email, $password);

        if (empty($data['users']))
        {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger"> <i class="fa fa-thumbs-down"></i> Usuário ou senha incorreto!</div>');
            return redirect()->to(base_url('login'))->withInput();
        }
        else
        {
            $sessionData = [
                'id'         => $data['users']['id'],
                'name'       => $data['users']['name'],
                'email'      => $data['users']['email'],
                'img'        => $data['users']['img'],
                'level'      => $data['users']['level'],
                'company_id' => $data['users']['company_id'],
                'created_at' => date("d/m/Y", strtotime($data['users']['created_at'])),
                'logged_in'  => true
            ];
            session()->set($sessionData);

            return redirect()->to(base_url('admin'))->withInput();
        }
    }
    
    /*Logout*/
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
