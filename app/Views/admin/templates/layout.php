<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/admin/favicon/favicon.ico">
        <!-- Bootstrap 3.0 com classses do 4 -->
        <link href="<?= base_url(); ?>/public/assets/admin/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />   

        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!-- Theme style -->
        <link href="<?= base_url(); ?>/public/assets/admin/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?= base_url(); ?>/public/assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /> 
        <!-- iCheck -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?= base_url(); ?>/public/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= base_url(); ?>/pt-BR/boards/tasks" class="logo"><img src="<?= base_url(); ?>/public/assets/admin/favicon/favicon.ico"/> <b></b></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!--search-->
                            <li class="dropdown tasks-menu">
                                <a href="#" data-toggle="modal" data-target="#search">
                                    <i class="fa fa-filter"></i>
                                </a>
                            </li>

                            <!-- User-->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                        if(!session()->get('img')){
                                            echo "<img src='" .base_url(). "/public/img/sem-imagem.jpg' class='user-image' alt='Usuário'/>";
                                        }else{
                                    ?>
                                    <img src="<?php echo base_url(); ?>/public/img/users/<?= session()->get('img'); ?>" class="user-image" alt="Usuário"/>
                                    <?php }?>
                                    Olá, <span class="hidden-xs"><?= session()->get('name'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php
                                            if(!session()->get('img')){
                                                echo "<img src='" .base_url(). "/public/img/sem-imagem.jpg' class='user-image' alt='Usuário'/>";
                                            }else{
                                        ?>
                                        <img src="<?php echo base_url(); ?>/public/img/users/<?= session()->get('img'); ?>" class="img-circle" alt="Usuário" />
                                            <?php }?>
                                        <p>
                                            <?= session()->get('name'); ?>
                                            <small>Cadastrado desde <?= session()->get('created_at'); ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url(); ?>/login/logout" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <?php echo $this->include('admin/templates/menu'); ?>

            <!--Content-->
            <div class="content-wrapper">
                <section class="content">
                    <?php echo $this->renderSection('content'); ?>
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2022 <a href="http://markp.com.br">MarkP</a>.</strong> Todos os direios reservados.
            </footer>

            <!-- Modal search -->
            <div class="modal fade" id="search" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-search"></i> Faça uma pesquisa</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="box-body">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="client">Cliente</label>
                                            <input type="text" class="form-control" id="client" placeholder="Informe o cliente">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label for="cnpj">CNPJ</label>
                                            <input type="text" class="form-control" id="cnpj" placeholder="CNPJ">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" selected="">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="user">Usuário</label>
                                            <input type="text" class="form-control" id="user" placeholder="Informe o usuário">
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>

                </div>
            </div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>

        <!-- seet alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>


        <link href="<?= base_url(); ?>/public/assets/admin/dist/js/jquery.js" rel="stylesheet" type="text/css" /> 
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url(); ?>/public/assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!-- Morris.js charts -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="<?= base_url(); ?>/public/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='<?= base_url(); ?>/public/assets/admin/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url(); ?>/public/assets/admin/dist/js/app.min.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= base_url(); ?>/public/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url(); ?>/public/assets/admin/dist/js/demo.js" type="text/javascript"></script>

        <!-- Sweet alert-->
        <script src="<?= base_url(); ?>/public/assets/admin/assets/sweetalert/sweetalert.min.js"></script>

        <!-- Tinymce -->
        <script src="https://cdn.tiny.cloud/1/42ua8shmdv5momjpgaboqve0gfn4tgdskbacrwlreq27jnwt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        
        <!-- mask input-->
        <script src="<?= base_url(); ?>/public/assets/admin/js/jquery.maskedinput.js"></script>
        
        <script>
                //Botões caregamento (create/update)
                $(".loading").on("click", function(){
                    $(".loading").html("<img src='<?= base_url(); ?>/public/assets/img/load.gif'/>");
                });
                
                //MASCARAS PRECISA DO maskedinput.js
                $("input.cnpj").mask("99.999.999/9999-99")
                $("input.ie").mask("999.999.999.999")
                $("input.celular").mask("(99)99999-9999")
                $("input.telefone").mask("(99)9999-9999")
                $("input.cpf").mask("999.999.999-99")
                $("input.rg").mask("99.999.999-9")
                $("input.nascimento").mask("99/99/9999")
                $("input.cep").mask("00000-000")
                $("input.hora").mask("99:99:99" ); 
                
            <!--users-->
            $('#update-user').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget)
                let company = button.data('company')
                let id     = button.data('id')
                let name   = button.data('name')
                let email  = button.data('email')
                let level  = button.data('level')
                let status = button.data('status')

                let modal  = $(this)
                modal.find('.modal-title').html('<i class="fa fa-check"></i> Editando Usuário - ' + name)
                modal.find('#company_id').val(company)
                modal.find('#id').val(id)
                modal.find('#name').val(name)
                modal.find('#email').val(email)
                modal.find('#level').val(level)
                modal.find('#status').val(status)
            });
        
            <!--contato-->
            $('#update-contact').on('show.bs.modal', function (event) {
                let button     = $(event.relatedTarget)
                let company   = button.data('company')
                let id        = button.data('id')
                let contact   = button.data('contact')
                let email     = button.data('email')
                let telephone = button.data('telephone')
                let mobile    = button.data('mobile')

                let modal  = $(this)
                modal.find('.modal-title').html('<i class="fa fa-check"></i> Editando Contato # ' + contact)
                modal.find('#id').val(id)
                modal.find('#company_id').val(company)
                modal.find('#contact').val(contact)
                modal.find('#email').val(email)
                modal.find('#telephone').val(telephone)
                modal.find('#mobile').val(mobile)
            })
            
            <!--CEP-->
            let cep = document.querySelector('#cep');
             
            cep.addEventListener('blur', ()=>{
                let search = cep.value.replace('-','')
                console.log(search)
                getAdress(search)
             })
             
             async function getAdress(cep){
                const url = `https://viacep.com.br/ws/${cep}/json/`;   
                const params = {
                    method: 'GET',
                    mode: 'cors',
                    cache: 'default'
                }         
                const response = await fetch(url, params);
                if (!response.ok) throw new Error('CEP inválido');
                const data = await response.json();
                console.log("Async ",data)
                
                showData(data)
            }
            
            function showData(data){
                for(let campo in data){
                    if(document.querySelector("#"+campo)){
                       console.log("Campo ",campo) 
                       document.querySelector("#"+campo).value = data[campo]
                    }   
                }
            }
                                 
        </script>

    </body>
</html>