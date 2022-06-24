<?php
    echo $this->extend('admin/templates/layout');
    echo $this->section('content');
?>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-12">

            <div class="box box-primary shadow">
                <div class="box-header mt-3">
                    <h3 class="box-title"><i class="fa fa-check"></i> <strong>Cadastro de Empresa</strong></h3>
                </div>
                
                <!--validation model-->
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-2 mb-2">
                    <?php 
                    
                        if(session()->has('errors_validation_model_company')){

                            echo "<ul>";
                                foreach(session('errors_validation_model_company') as $errorCompany){
                                    echo "<li class='text-danger'>$errorCompany</li>";
                                }
                            echo "</ul>";

                        } 
                
                        if(session()->has('errors_validation_model_contact')){

                            echo "<ul>";
                                foreach(session('errors_validation_model_contact') as $errorContact){
                                    echo "<li class='text-danger'>$errorContact</li>";
                                }
                            echo "</ul>";

                        } 
                    ?>
                </div>
       
                <form action="<?php echo base_url(); ?>/admin/company/store" method="post" enctype="multipart/form-data">

                    <!--empresa-->
                    <div class="row box-body">
                        <div class="form-group">
                            <div class="col-md-10">
                                <label for="company">Empresa</label>
                                <input type="text" name="company" class="form-control" value="<?= old('company');?>" placeholder="Digite o nome da empresa...">
                            </div>
                            <div class="col-md-2">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" name="cnpj" class="form-control cnpj" value="<?= old('cnpj');?>" placeholder="Informe o CNPJ...">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-2 mt-3">
                                <label for="cep">CEP</label>
                                <input type="text" name="cep" class="form-control" id="cep" placeholder="Informe o CEP...">
                            </div>
                            <div class="col-md-5 mt-3">
                                <label for="adress">Endereço</label>
                                <input type="text" name="adress" class="form-control" id="logradouro" value="<?= old('adress'); ?>" placeholder="Digite o Endereço...">
                            </div>
                            <div class="col-md-5 mt-3">
                                <label for="district">Bairro</label>
                                <input type="text" name="district" class="form-control" id="bairro" value="<?= old('district'); ?>" placeholder="Digite o Bairro...">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 mt-3">
                                <label for="city">Cidade</label>
                                <input type="text" name="city" class="form-control" id="localidade" value="<?= old('city'); ?>" placeholder="Digite a Cidade..">
                            </div>
                            <div class="col-md-3 mt-3">
                                <label>UF</label>
                                <input class="form-control" type="text" name="uf" id="uf" value="<?= old('uf'); ?>">
                            </div>
                            <div class="col-md-3 mt-3">
                                <label for="number">Nº</label>
                                <input type="text" name="number" class="form-control" value="<?= old('number');?>" placeholder="Digite o número..">
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-footer mt-5">
                        <button type="submit" class="btn btn-primary submit">Cadastrar</button> 
                        <a href="<?= base_url(); ?>/pt-BR/boards/company/listar-empresa" class="btn btn-default"><i class="fa fa-mail-reply"></i> Listar empresa</a>
                    </div>
                    
                    <script> 
//                        let contact  = document.querySelector('.contact');
//                        let email    = document.querySelector('.email');
//                        let telefone = document.querySelector('.telefone');
//                        let celular  = document.querySelector('.celular');
//                        let submit   = document.querySelector('.submit');
//                        
//                        contact.addEventListener("keyup", function() {
//                            if(contact.value != "") {
//                              submit.disabled = false;
//                            } else {
//                              submit.disabled = true;
//                            }
//                        });
                        
                        
//                        function checkInputs(inputs) {
//                            var filled = true;
//
//                            inputs.forEach(function(input) {
//
//                              if(input.value === "") {
//                                  filled = false;
//                              }
//
//                            });
//
//                            return filled;
//
//                          }
//                          var inputs = document.querySelectorAll("input");
//                          var button = document.querySelector("button");
//                          inputs.forEach(function(input) {
//
//                            input.addEventListener("keyup", function() {
//                              if(checkInputs(inputs)) {
//                                button.disabled = false;
//                              } else {
//                                button.disabled = true;
//                              }
//                            });
//                        });
                    </script>
                </form>
                
                <?= csrf_field();?>
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>

