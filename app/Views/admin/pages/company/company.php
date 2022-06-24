<?php
    echo $this->extend('admin/templates/layout');
    echo $this->section('content');
?>
<div class="container">

    <div class="row mt-5">

        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <a href="<?= base_url();?>/pt-BR/boards/company/cadastro-empresa" class="btn btn-info">
                Cadastrar Nova Empresa <i class="fa fa-plus-square"></i>
            </a>        
        </div>
        
        <!--msg-->
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
            <?= $msg;?>
        </div>
        
        <!--validation model usuario-->
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
            <?php if(session()->has('errors_validation_model_user')){
                
                echo "<ul>";
                    foreach(session('errors_validation_model_user') as $errorUser){
                        echo "<li class='text-danger'>$errorUser</li>";
                    }
                echo "</ul>";
                
            }
            ?>
        </div>
        
        <!--search-->
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6 mt-3">
            <form action="<?php echo base_url(); ?>/pt-BR/boards/company/pesquisa-empresa" method="post">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Pesquise a empresa...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
            <div class="table-responsive">
       
                <table class="table table-striped" style="width: 100%">

                    <thead class="thead-dark">
                        <tr>
                            <td>Total cadastrado <span class="badge"><?= $count;?></span></td>
                            <td colspan="5"></td>
                            <td class="text-right" title="Exportar tabela para CSV Excel"><a href="<?php echo base_url(); ?>/pt-BR/boards/company/exportar-excel" class="btn btn-success"><i class="fa fa-table"></i> Exportar Excel</a></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Cadastro</th>
                            <th><i class="fa fa-check"></i> Empresa</th>
                            <th><i class="fa fa-user"></i> Contato</th>
                            <th><i class="fa fa-envelope"></i> E-mail</th>
                            <th><i class="fa fa-phone"></i> Celular</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if(empty($companys)){
                            echo "<tr>
                                <td colspan='3'></td>
                                <td class='text-danger'><strong><i class='fa fa-exclamation'></i> Nenhuma empresa encontrada</strong></td>
                                <td colspan='3'></td>
                            </tr>";
                        }else{
                        foreach ($companys as $company)
                        {
                            extract($company);
                            if(empty($companys)){
                                echo "<tr><td> Nenhum item cadastrado</td></tr>";
                            }else{
                            ?>
                            <tr>
                                <td><i class="fa fa-check"></i> <?= date('d/m/Y', strtotime($created_at)); ?></td>
                                <td><?= $company; ?></td>
                                <td><?= $contact; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $mobile; ?></td>
                                <td><?php echo anchor(base_url('pt-BR/boards/company/editar-empresa/'. $id),'<i class="fa fa-edit"></i>', ['class' => 'btn btn-success']);?></td>
                                <td><?php echo anchor(base_url('admin/company/delete/'. $id),'<i class="fa fa-remove"></i>', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente exluir?")']);?></td>
                            </tr>
                    <?php }}} ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
     
    <!-- pagination -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center">
            <?= $pager->links(); ?>
        </div>
    </div>
    
</div>


<?= $this->endSection();?>