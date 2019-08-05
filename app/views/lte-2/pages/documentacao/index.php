<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Documentação - SPI - Sistema de Pesquisa Interna - Cabral Gama Imobiliária</title>
        <!-- Diz para o navegador ser responsivo na largura da tela -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="shortcut icon" href="<?= DIR_IMG; ?>favicon.ico">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= URL_MIN; ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">
        <!-- Admin LTE -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>dist/css/AdminLTE.min.css">
        <!-- CSS Custom -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>dist/css/custom.css">
        <!-- AdminLTE Skin -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>dist/css/skins/skin-purple.min.css">

        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>pages/documentacao/style.css">

    </head>

    <body class="hold-transition skin-purple fixed">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?= URL_ROOT; ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>C</b>G</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?= DIR_IMG; ?>logo-190x40.fw.png" /></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                        </ul>
                    </div>
                </nav>

            </header>
            <!-- Coluna lateral, contém o Bem Vindo e Menu Lateral -->
            <aside class="main-sidebar">
                <div class="sidebar" id="scrollpsy">
                    <ul class="nav sidebar-menu">
                        <li class="header">DOCUMENTAÇÃO</li>
                        <li><a href="#introducao"><i class="fa fa-circle-o text-orange"></i> Introdução</a></li>
                        <li><a href="#dependencias"><i class="fa fa-circle-o text-red"></i> Dependências</a></li>
                        <li><a href="#plugins"><i class="fa fa-circle-o text-aqua"></i> Plugins</a></li>
                        <li><a href="#versao"><i class="fa fa-circle-o text-green"></i> Versão</a></li>
                        <li><a href="#desenvolvedor"><i class="fa fa-circle-o text-gray"></i> Desenvolvedor</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Content Wrapper. Conteudo da página -->
            <div class="content-wrapper">
                <div class="content-header">
                    <h1>
                        SPICG - Documentação
                        <small>Versão atual 2.0.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Início</a></li>
                        <li class="active">Documentação</li>
                    </ol>
                </div>
                <div class="content body">
                    <section id="introducao">
                        <h2 class="page-header"><a href="#introducao">Introdução</a></h2>
                        <p class="lead">
                            <strong>SPICG</strong> é um Sistema de Pesquisa Interna desenvolvido especificamente para a <strong>Cabral Gama Imobiliária</strong>
                            com o objetivo de facilitar o gerenciamento e atendimento da empresa.<br />
                            Layout baseado totalmente no Framework CSS <a href="http://getbootstrap.com" target="_blank">Bootstrap 3</a> e no template <a href="https://almsaeedstudio.com/" target="_blank">AdminLTE</a>.
                        </p>
                    </section>

                    <section id="dependencias">
                        <h2 class="page-header"><a href="#dependencias">Dependências</a></h2>
                        
                        <?php include ('app/views/lte-2/pages/documentacao/_inc/dependencias.php') ?>
                        
                    </section>
                    
                    <section id="plugins">
                        <h2 class="page-header"><a href="#plugins">Plugins</a></h2>
                        
                        <?php include ('app/views/lte-2/pages/documentacao/_inc/plugins.php') ?>
                        
                    </section>
                    
                    <section id="versao">
                        <h2 class="page-header"><a href="#versao">Versão</a></h2>
                        
                        <?php include('app/views/lte-2/pages/documentacao/_inc/versao.php') ?>
                        
                    </section>
                    
                    <section id="desenvolvedor">
                        <h2 class="page-header"><a href="#desenvolvedor">Desenvolvedor</a></h2>
                        <p>
                            Criado e Desenvolvido por <a href="http://twitter.com/Shiir0" target="_blank">Thalisson Barbosa</a>
                        </p>
                    </section>
                </div>

            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <?php include ('app/views/lte-2/_inc/footer.inc.php') ?>
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.2.2 -->
        <script src="<?= URL_MIN; ?>assets/plugins/jQuery/jQuery-2.2.2.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>dist/js/app.min.js"></script>

    </body>
</html>
