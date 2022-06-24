<?php
echo $this->extend('admin/templates/layout');
echo $this->section('content');
?>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-12">

            <div class="box box-success shadow">
                <div class="box-header mt-3">
                    <h3 class="box-title"><i class="fa fa-edit"></i> <strong>Editando Empresa</strong></h3>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-2 mb-2">
                    <?= $msg;?>
                </div>

                <!--validation model-->
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-2 mb-2">
                    <?php
                    if (session()->has('errors_validation_model_company'))
                    {

                        echo "<ul>";
                        foreach (session('errors_validation_model_company') as $error)
                        {
                            echo "<li class='text-danger'>$error</li>";
                        }
                        echo "</ul>";
                    }
                  
                    if (session()->has('errors_validation_model_user'))
                    {

                        echo "<ul>";
                        foreach (session('errors_validation_model_user') as $errorUser)
                        {
                            echo "<li class='text-danger'>$errorUser</li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>

                <form action="<?php echo base_url(); ?>/admin/company/update" method="post">
                    <?php 
                        foreach($companys AS $company){
                            extract($company);
                    ?>
                    
                    <input type="hidden" name="id" class="form-control" value="<?= $id; ?>">

                    <!--empresa-->
                    <div class="row box-body">
                        <div class="form-group">
                            <div class="col-md-10">
                                <label for="company">Empresa</label>
                                <input type="text" name="company" class="form-control" value="<?= old('company',$company); ?>">
                            </div>
                            <div class="col-md-2">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" name="cnpj" class="form-control cnpj" value="<?= old('cnpj',$cnpj); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 mt-3">
                                <label for="cep">CEP</label>
                                <input type="text" name="cep" class="form-control" value="<?= old('cep',$cep); ?>" id="cep" maxlength="9">
                            </div>
                            <div class="col-md-5 mt-3">
                                <label for="adress">Endereço</label>
                                <input type="text" name="adress"  value="<?= old('adress',$adress); ?>" class="form-control" id="logradouro">
                            </div>
                            <div class="col-md-5 mt-3">
                                <label for="district">Bairro</label>
                                <input type="text" name="district" value="<?= old('district', $district); ?>" class="form-control" id="bairro">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 mt-3">
                                <label for="city">Cidade</label>
                                <input type="text" name="city" value="<?= old('city',$city); ?>" class="form-control" id="localidade">
                            </div>
                            <div class="col-md-3 mt-3">
                                <label>UF</label>
                                <input class="form-control" type="text" name="uf" id="uf" value="<?= old('uf',$uf); ?>">
                            </div>
                            <div class="col-md-3 mt-3">
                                <label for="number">Nº</label>
                                <input type="text" name="number" class="form-control" value="<?= old('number', $number); ?>">
                            </div>
                        </div>
                        
                    </div>
                    <?php }?>
                    <div class="box-footer mt-5">
                        <button type="submit" class="btn btn-success submit"><i class="fa fa-edit"></i></button>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-contact">Novo contato <i class="fa fa-check"></i></a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-user">Novo usuário <i class="fa fa-user"></i></a>
                        <a href="<?= base_url(); ?>/pt-BR/boards/company/listar-empresa" class="btn btn-default"><i class="fa fa-mail-reply"></i> Listar empresa</a>
                    </div>
                </form>
                <?= csrf_field();?>
            </div>
        </div>
    </div>
    
    <!--Modal create contact-->
    <div class="modal fade" id="create-contact" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Novo Contato</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
 
                    <form action="<?php echo base_url();?>/admin/contact/store" method="post">
                       
                        <input type="hidden" class="form-control" name="company_id" value="<?= $id;?>">
                        
                        <div class="form-group">
                            <label>Contato</label>
                            <input type="text" class="form-control" name="contact" value="<?= old('contact');?>" placeholder="Nome do contato...">
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" value="<?= old('email');?>" placeholder="E-mail do contato...">
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-6">    
                                <label>Telefone</label>
                                <input type="text" class="form-control telefone" name="telephone" value="<?= old('telephone');?>" placeholder="Telefone do contato...">
                            </div>
                            <div class="col-md-6">  
                                <label>Celular</label>
                                <input type="text" class="form-control celular" name="mobile" value="<?= old('mobile');?>" placeholder="Celular do contato...">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary loading">Cadastrar</button>
                        </div>
                
                        <?= csrf_field();?>
                      
                    </form> 
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal update contact-->
    <div class="modal fade" id="update-contact" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h3 class="modal-title"><i class="fa fa-check"></i></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
 
                    <form action="<?php echo base_url();?>/admin/contact/store" method="post">
                        
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="company_id" id="company_id" value="">
                        
                        <div class="form-group">
                            <label>Usuário</label>
                            <input type="text" class="form-control" name="contact" id="contact" value="">
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" value="">
                        </div>
                        
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" class="form-control telefone" name="telephone" id="telephone" value="" maxlength="13">
                        </div>
                       
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" class="form-control celular" name="mobile" id="mobile" value="" maxlength="14">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success loading">Atualizar</button>
                        </div>
                
                        <?= csrf_field();?>
                      
                    </form> 
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal create user-->
    <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Novo Usuário</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form action="<?php echo base_url();?>/admin/usuarios/store" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" class="form-control" name="company_id" value="<?= $id;?>">
                        
                        <div class="form-group">
                            <label>Usuário</label>
                            <input type="text" class="form-control" name="name" placeholder="Insira o nome de usuário" value="<?= old('name');?>">
                        </div>

                        <div class="form-group">
                            <label>Login</label>
                            <input type="email" class="form-control" name="email" placeholder="Insira o email para login" value="<?= old('email');?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Insira uma senha forte" value="" maxlength="6">
                        </div>

                        <div class="form-group">
                            <label>Imagem</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang">Selecine o arquivo</label>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Ativo</option>
                                    <option value="2">Inativo</option>   
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Nivel</label>
                                <select name="level" class="form-control">
                                    <option value="1">Administrado</option>
                                    <option value="2">Operador</option>   
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary loading">Cadastrar</button>
                        </div>
                
                        <?= csrf_field();?>
                      
                    </form> 
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal update user-->
    <div class="modal fade" id="update-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h3 class="modal-title"><i class="fa fa-check"></i></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
 
                    <form action="<?php echo base_url();?>/admin/usuarios/storeUpdate" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="company_id" id="company_id" value="">
                        
                        <div class="form-group">
                            <label>Usuário</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Insira o nome de usuário" value="" required="">
                        </div>

                        <div class="form-group">
                            <label>Login</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Insira o email" value="" required="">
                        </div>
                       
                        <div class="form-group">
                            <label>Imagem</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang">Selecine o arquivo</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Nivel</label>
                            <select name="level" class="form-control" id="level">
                                <option value="1">Administrador</option>
                                <option value="2">Operador</option>   
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Ativo</option>
                                <option value="2">Inativo</option>   
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success loading">Atualizar</button>
                        </div>
                
                        <?= csrf_field();?>
                      
                    </form> 
                </div>
            </div>
        </div>
    </div> 

    <!--Contatos-->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                <table class="table table-striped" style="width: 100%">

                    <thead class="thead-dark">
                        <tr>
                            <th><i class="fa fa-user"></i> Contato</th>
                            <th><i class="fa fa-envelope"></i> E-mail</th>
                            <th><i class="fa fa-phone"></i> Celular</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($contacts as $contact)
                        {
                            extract($contact);
                            if (empty($contacts))
                            {
                                echo "<tr><td> Nenhum item cadastrado</td></tr>";
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td><?= $contact; ?></td>
                                    <td><?= $email; ?></td>
                                    <td><?= $mobile; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#update-contact" 
                                            data-company="<?= $company_id;?>"
                                            data-id="<?= $id;?>"
                                            data-contact="<?= $contact;?>"
                                            data-email="<?= $email;?>"
                                            data-telephone="<?= $telephone;?>"
                                            data-mobile="<?= $mobile;?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td><?php echo anchor(base_url('admin/contact/delete/' . $id. '/' .$company_id), '<i class="fa fa-remove"></i>', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente exluir?")']); ?></td>
                                </tr>
                        <?php }} ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    
    <!--usuarios-->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                <table class="table table-striped" style="width: 100%">

                    <thead class="thead-dark">
                        <tr>
                            <th><i class="fa fa-user"></i> Usuário</th>
                            <th><i class="fa fa-envelope"></i> Login</th>
                            <th><i class="fa fa-check"></i> Nivel</th>
                            <th><i class="fa fa-check"></i> Status</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (empty($users))
                        {
                            echo "<tr><td colspan='3'> <td class='text-danger'><strong>Nenhum usuário cadastrado</strong></td><td colspan='2'></td></tr>";
                        }else{
                        foreach ($users as $user)
                        {
                            extract($user);
                            
                                switch($level){
                                    case 1:
                                        $levelName = "Administrador";
                                    break;
                                    case 2:
                                        $levelName = "Operador";
                                    break;
                                }
                                
                                switch($status){
                                    case 1:
                                        $statusName = "<span class='btn btn-success'>Ativo</span>";
                                    break;
                                    case 2:
                                        $statusName = "<span class='btn btn-danger'>Inativo</span>";
                                    break;
                                }
                        
                            ?>
                            <tr>
                                <td><?= $name; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $levelName;?></td>
                                <td><?= $statusName; ?></td>
                                <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#update-user" 
                                       data-company="<?= $company_id;?>"
                                       data-id="<?= $id;?>"
                                       data-name="<?= $name;?>"
                                       data-email="<?= $email;?>"
                                       data-level="<?= $level;?>"
                                       data-status="<?= $status;?>"
                                       ><i class="fa fa-edit"></i></a></td>
                                <td><?php echo anchor(base_url('admin/usuarios/delete/' . $id. '/' .$company_id), '<i class="fa fa-remove"></i>', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente exluir?")']); ?></td>
                            </tr>
                        <?php }} ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
   
</div>

<?= $this->endSection(); ?>

