<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?= (!empty($_GET['controller'])) ? ucfirst($_GET['controller']) . " | " : '' ?>SPI - Sistema de Pesquisa Interna - Cabral Gama Imobiliária</title>
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

        <?php include ('app/views/lte-2/_inc/head.inc.php') ?>

    </head>

    <body class="hold-transition skin-purple sidebar-mini fixed">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <?php include ('app/views/lte-2/_inc/header.inc.php'); ?>

            </header>
            <!-- Coluna lateral, contém o Bem Vindo e Menu Lateral -->
            <aside class="main-sidebar">

                <?php include ('app/views/lte-2/_inc/sidebar.inc.php'); ?>

            </aside>

            <!-- Content Wrapper. Conteudo da página -->
            <div class="content-wrapper">
                <!-- Content Header  -->
                <section class="content-header">
                    <h1>
                        <?php
                        if ($_GET['controller'] == ""):
                            echo "Início <small>Página principal</small>";
                        else:
                            echo mb_ucwords($_GET['controller']);
                        endif;
                        ?>
                        <small><?= mb_ucwords($_GET['action']) ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <?= breadcrumbsLTE(); ?>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">

                    <div id="messages"></div>

                    <?php
                    if (isset($_GET['search'])):
                        include ('app/views/lte-2/_inc/search.inc.php');
                    else:
                        require($view);
                    endif;
                    ?>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">

                <?php include ('app/views/lte-2/_inc/footer.inc.php'); ?>

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
        <!-- Global Settings -->
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>dist/js/global.js"></script>
        <!-- Input Mask -->

        <script src="<?= URL_MIN; ?>assets/plugins/input-mask/min/inputmask.min.js"></script>
        <script src="<?= URL_ROOT; ?>assets/plugins/input-mask/min/jquery.inputmask.min.js"></script>
        <script src="<?= URL_MIN; ?>assets/plugins/maskmoney/jquery.maskMoney.min.js"></script>
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>dist/js/inputmask.js"></script>

        <!-- Page Scripts -->
        <?php include ('app/views/lte-2/_inc/scripts.inc.php'); ?>

        <!-- Modal Atendimento Fixo-->
        <?php include ('app/views/lte-2/_inc/modals/modal-atendimento.inc.php'); ?>

        <!-- Page Modals -->
        <?php include ('app/views/lte-2/_inc/modals.inc.php'); ?>

    </body>
</html>
