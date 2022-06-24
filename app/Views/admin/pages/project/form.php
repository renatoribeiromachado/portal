<?php
    echo $this->extend('admin/templates/layout');
    echo $this->section('content');
?>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-12">

            <div class="box box-primary shadow">
                <div class="box-header mt-3">
                    <h3 class="box-title"><i class="fa fa-check"></i> <strong>Cadastro de Projeto</strong></h3>
                </div>
                
                <!--validation model-->
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-2 mb-2">
                    <?php 
                    
                        if(session()->has('errors_validation_model_project')){

                            echo "<ul>";
                                foreach(session('errors_validation_model_project') as $error){
                                    echo "<li class='text-danger'>$error</li>";
                                }
                            echo "</ul>";

                        } 
                    ?>
                </div>
       
                <form action="<?php echo base_url(); ?>/admin/project/store" method="post" enctype="multipart/form-data">

                    <!--empresa-->
                    <div class="row box-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="title">Titulo</label>
                                <input type="text" name="title" class="form-control" value="<?= old('title');?>" placeholder="Digite o nome da empresa...">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 mt-2">
                                <label for="description">Descrição</label>
                                <textarea name="description" class="form-control" rows="5"><?= old('descripition');?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-3 mt-2">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <?php
                                        foreach($briefings AS $briefing){
                                            extract($briefing);
                                    ?>
                                    <option value="<?= $id;?>"><?= $title;?></option>
                                    <?php }?>
                                </select>
                            </div>
                 
                            <div class="col-md-3 mt-2">
                                <label>Imagem</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" name="img" id="customFileLang" lang="es">
                                    <label class="custom-file-label" for="customFileLang">Selecine o arquivo</label>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div class="box-footer mt-5">
                        <button type="submit" class="btn btn-primary submit">Cadastrar</button> 
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

