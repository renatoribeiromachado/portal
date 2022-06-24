<div class="container">

    <div class="row mt-5">
        <!--contagem-->
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
            <p>Total encontrado(s): <strong><?= $count; ?></strong></p> 
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 mt-3">

            <table class="table table-striped shadow"> 

                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Telefone</th>
                        <th class="text-center">Empresa</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Cidade</th>
                        <th class="text-center">Origem</th>
                        <th class="text-center">Mensagem</th>
                        <th class="text-center">Midia</th>
                        <th class="text-center">Outro</th>
                        <th class="text-center">Data</th>
                        <th class="text-center"><i class="fa fa-remove"></i></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($contacts as $contact)
                    {
                        extract($contact);
                    ?>
                    <tr>
                        <td><?= $co_nome; ?></td>
                        <td><?= $co_telefone; ?></td>
                        <td><?= $co_empresa; ?></td>
                        <td><?= $co_email; ?></td>
                        <td><?= $co_cidade; ?></td>
                        <td><?= $co_origem; ?></td>
                        <td>
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#msg" 
                                data-id='<?= $co_codigo;?>' 
                                data-content='<?= $co_mensagem;?>'>Ver mensagem
                            </a>
                        </td>
                    
                        <td><?= $co_midia; ?></td>
                        <td><?= $co_outro; ?></td>
                        <td><?= date('d/m/Y', strtotime($co_cadastro)); ?></td>
                        <td class="text-center"><?php echo anchor(base_url('admin/contato/delete/' . $co_codigo), 'Excluir', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente exluir?")']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
            <?php echo $pager->links(); ?>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="msg" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="content" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- importante para o rodapé-->
</div>
</div>