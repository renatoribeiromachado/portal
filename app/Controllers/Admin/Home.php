<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MenuAdmModel;

class Home extends BaseController
{
    private $userModel;
    
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
            'title'       => 'Painel de controle',
            'description' => 'Cadastro Edição e Exclusão'
        ];

        echo view('admin/pages/home', $data);

    }
}
