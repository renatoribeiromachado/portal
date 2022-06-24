<?php

namespace App\Controllers\Admin;
 
use App\Controllers\BaseController;
use App\Models\ContactCompanyModel;
use App\Models\UserModel;
use App\Models\CompanyModel;
use CodeIgniter\Controller;
use App\Models\MenuAdmModel; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  
class Company extends BaseController
{
    private $contactModel;
    private $companyModel; 
    private $menuModel;  
    private $userModel; 
  
       
    public function __construct()
    {
        $this->session      = session();
        $this->contactModel = new ContactCompanyModel();
        $this->companyModel = new CompanyModel();
        $this->menuModel    = new MenuAdmModel(); 
        $this->userModel    = new UserModel(); 
    }
    
    public function index()
    {
        $data = [
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Listagem de empresa',
            'description' => 'Listagem',
            'contact'     => $this->contactModel->findAll(),
            'companys'    => $this->companyModel->getCompanyContactUsers()->orderby('name','asc')->paginate(20),
            'pager'       => $this->companyModel->pager,
            'count'       => $this->companyModel->countAllResults(),
        ];
        
        return view('admin/pages/company/company',$data);
    }
    
    public function create()
    {
        $data = [
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Cadastro de empresa',
            'description' => 'Cadastro',
            'contact'     => $this->contactModel->findAll(),
            'companys'    => $this->companyModel->getCompanyContactUsers()->findAll()
        ];

        return view('admin/pages/company/form',$data);
    }
    
    /*store*/
    public function store()
    {
        if($this->request->getMethod() === 'post'){

            $data = [
                'id'         => $this->request->getPost('id'),
                'company'    => $this->request->getPost('company'),
                'cnpj'       => $this->request->getPost('cnpj'),
                'cep'        => $this->request->getPost('cep'),
                'adress'     => $this->request->getPost('adress'),
                'district'   => $this->request->getPost('district'),
                'city'       => $this->request->getPost('city'),
                'uf'         => $this->request->getPost('uf'),
                'number'     => $this->request->getPost('number'),
                'user_id'    => session()->get('id'),
            ]; 

            //Salva empresa
            if($return_id = $this->companyModel->insert($data)){
                /*Se gravou tudo certo empresa, vai para tela de editar para se inserido contato e usuario levando o ultimo id*/
                $this->session->setFlashdata('msg',"<div class='alert alert-success'> Cadastrado com sucesso</div>");
                return redirect()->to(base_url('pt-BR/boards/company/editar-empresa/' .$return_id));
            }else{
                return redirect()->to(base_url('pt-BR/boards/company/cadastro-empresa'))
                        ->with('errors_validation_model_company',$this->companyModel->errors())->withInput();        
            }
        }
        return "Erro"; 
    }
    
    /*abre formulario de edição - editar-empresa*/
    public function edit($id = null)
    {
        $data = [
                'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
                'title'       => 'Editando empresa',
                'description' => 'Edição',
                'msg'         => $this->session->getFlashdata('msg'),
                'companys'    => $this->companyModel->where('id', $id)->findAll(),
                'contacts'    => $this->contactModel->where('company_id', $id)->orderby('contact','asc')->findAll(),
                'users'       => $this->userModel->where('company_id', $id)->orderby('name','asc')->findAll()
            ];
        
            return view('admin/pages/company/form-update',$data);

    }
    
    /*update*/
    public function update()
    {
         
        if($this->request->getMethod() === 'post'){
            $data = [
                'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
                'title'       => 'Editando de empresa',
                'description' => 'Edição',
                'id'          => $this->request->getPost('id'),
                'company'     => $this->request->getPost('company'),
                'cnpj'        => $this->request->getPost('cnpj'),
                'cep'         => $this->request->getPost('cep'),
                'adress'      => $this->request->getPost('adress'),
                'district'    => $this->request->getPost('district'),
                'city'        => $this->request->getPost('city'),
                'uf'          => $this->request->getPost('uf'),
                'number'      => $this->request->getPost('number'),
                'user_id'    => session()->get('id')
            ];
       
        
            if($this->companyModel->save($data)){
                $this->session->setFlashdata('msg',"<div class='alert alert-success'> Atualizado com sucesso</div>");
                return redirect()->to(base_url('admin/company/edit/' . $this->request->getPost('id')))
                        ->withInput();
            }else{
                return redirect()->to(base_url('admin/company/edit/' . $this->request->getPost('id')))
                    ->with('errors_validation_model_company',$this->companyModel->errors())
                    ->withInput();
            }

         }
       
    }
    
    /*pesquisa*/
    public function search()
    {
        $search = $this->request->getVar('search');

        $data = [
            'companys'    => $this->companyModel->getSearch($search)->paginate(1),
            'menus'       => $this->menuModel->getMenu()->where('level',session()->get('level'))->findAll(),
            'msg'         => $this->session->getFlashdata('msg'),
            'title'       => 'Listagem de empresa',
            'description' => 'Listagem',
            'contact'     => $this->contactModel->findAll(),
            'pager'       => $this->companyModel->pager,
            'count'       => $this->companyModel->getSearch($search)->countAllResults(),
        ];

        return view('admin/pages/company/company',$data);
    }
    
    /*Exportar Excel*/
    public function exportar()
    {  
        $spreadsheet = new Spreadsheet();        
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'COD');
        $sheet->setCellValue('B1', 'Empresa');
        $sheet->setCellValue('C1', 'CNPJ');
        $sheet->setCellValue('D1', 'CONTATO');
        $sheet->setCellValue('E1', 'USUÁRIO(s)');
        $sheet->setCellValue('F1', 'LOGIN(s)');
        $sheet->setCellValue('G1', 'NIVEL');
        $sheet->setCellValue('H1', 'STATUS');
        $sheet->setCellValue('I1', 'CADASTRO');
        $rows = 2;
        
        $companys = $this->companyModel->getCompanyContactUsers()->orderby('name','asc')->findAll();
        
        foreach($companys AS $key => $company){
            extract($company);
           
            $sheet->setCellValue('A' . $rows, "#" .$id);
            $sheet->setCellValue('B' . $rows, $company);
            $sheet->setCellValue('C' . $rows, $cnpj);
            $sheet->setCellValue('D' . $rows, $contact);
           
           //Usuarios
            foreach($this->userModel->where('company_id', $id)->findAll() AS $user){
                extract($user);
                $sheet->setCellValue('E' . $rows, $name);
                $sheet->setCellValue('F' . $rows, $email);
                $sheet->setCellValue('G' . $rows, $level == 1 ? "Administrador" : "Operador");
                $sheet->setCellValue('H' . $rows, $status == 1 ? "Ativo" : "Inativo");
                $sheet->setCellValue('I' . $rows, date("d/m/Y", strtotime($created_at)));
                $rows++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('world.xlsx');
        return $this->response->download('world.xlsx', null)->setFileName('empresas.xlsx');

    }
    
    /*delete*/
    public function delete($id){
        //dd($id);
        if($this->companyModel->delete($id)){
            $this->session->setFlashdata('msg','<div class="alert alert-danger"> <i class="fa fa-thumbs-up"></i> Deletado com sucesso</div>');
            return redirect()->to(base_url('admin/company'));
        }
    } 
}       