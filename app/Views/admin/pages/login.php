<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?= $title;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= base_url();?>/public/assets/admin/bootstrap/css/bootstrap-5.css?v=5" rel="stylesheet">  
        <link href="<?= base_url();?>/public/assets/admin/assets/css/style.css?v=6" rel="stylesheet">
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url();?>/public/assets/admin/favicon/favicon.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head> 
    
    <body style="background: linear-gradient(to right, rgba(91, 149, 171, 2), rgba(0, 204, 255, 0.75))">

        <div class="container-fluid">
            <div class="row m-1" style="padding-top: 230px;">

                <div class="col-md-12 col-sm-12 col-lg-4 offset-lg-4 rounded-3 shadow-lg bg-light media-form-login">
                   
                    <!--msg-->
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
                        <?= $msg; ?>
                    </div>
                    
                    <div class="m-2 text-center">
                        <img src="<?= base_url();?>/public/assets/admin/assets/images/logo.png" alt="Login de acesso" class="img-fluid"/>
                    </div>
                    <form action="login\logar" method="post">
                        <!-- USER -->
                        <div class="input-group mb-3">
                            <div class="input-group-text"><i class="fa fa-user p-2-icon"></i></div>
                            <input type="text" name="email" class="form-control"  value="<?= old('email');?>" placeholder="Digite o login de usuário" required=""/>                                        
                        </div>

                        <!-- PASSWORD -->
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                            <input type="password" name="password" class="form-control"  value="" placeholder="Informe a senha" required=""/>
                        </div>

                        <!-- Button -->  
                        <div class="mt-3 mb-3 text-end">
                            <input type="submit" name="AdminLogin" value="Acessar" class="btn btn-login submit"/>
                        </div>
                        
                        <div class="p-1">
                            <p class="text-muted fs-6">Versão 1.0 - 2022</p>
                        </div>
                        <!--
                        <?= csrf_field();?>
                        -->
                    </form>
                </div>
                
            </div>
        </div>
        
    </body>
</html>