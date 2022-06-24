<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\MenuModel;


class Home extends BaseController {

    private $menuModel;
    private $serviceModel;

    public function __construct()
    {
        
    }

    public function index()
    {
        
    }


    public function sendEmail()
    {
        if ($this->request->getMethod() === 'post')
        {
            $name = $this->request->getVar('name');
            $emailFrom = $this->request->getVar('email');
            $subject = $this->request->getVar('subject');
            $mensage = $this->request->getVar('mensage');

            $email = \Config\Services::email();
            $email->setFrom($emailFrom, $name);
            $email->setTo('renato@acessohost.com.br');
            //$email->setCC('another@another-example.com');
            //$email->setBCC('them@their-example.com');

            $email->setSubject($subject);
            $email->setMessage("Nome: " . $name . "\nAssunto: " . $subject . "\nE-mail: " . $emailFrom . "\nMensagem: " . $mensage);

            $email->send();

            if ($email->send(false))
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger"> <i class="fa fa-thumbs-down"></i> Erro ao tentar enviar mensagem</div>');
                $this->contact();
            }
            else
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-success"> <i class="fa fa-thumbs-up"></i> Mensagem enviada com sucesso</div>');
                $this->contact();
            }
        }
    }

}
