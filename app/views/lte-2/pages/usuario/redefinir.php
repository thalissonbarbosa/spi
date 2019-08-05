<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Redefinir Senha | SPI - Sistema de Pesquisa Interna - Cabral Gama Imobiliária</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= URL_MIN; ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">
        <!-- Admin LTE -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>dist/css/AdminLTE.min.css">
        <!-- CSS Custom -->
        <link rel="stylesheet" href="<?= URL_MIN . DIR_LAYOUT; ?>dist/css/custom.css">

    </head>
    <body class="hold-transition login-page" style="background: url('<?= DIR_IMG; ?>background_login3.jpg') left repeat;">
        <div class="login-box">
            <div class="login-logo">

                <a href="./"><img src="<?= DIR_IMG; ?>logo-cabral-gama-inverse.png" style="width:80%" /></a>

            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <br />

                <?php
                /*
                 * Verificando token
                 */
                $Usuario = new \App\Models\Usuario();
                $token = $Usuario->verificaToken($_GET['token'], $_GET['id']);

                if ($token != false):
                    ?>
                    <form id="redefinir_senha" action="" method="post">
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control input-lg" name="senha" required placeholder="Nova Senha">
                            <i class="fa fa-lock form-control-feedback"></i>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control input-lg" name="senha2" required placeholder="Confirme a senha">
                            <i class="fa fa-lock form-control-feedback"></i>
                        </div>
                        <div>
                            <input type="hidden" name="id" value="<?= $_GET['id']; ?>" />
                            <button type="submit" class="btn bg-olive btn-block btn-lg btn-flat">Enviar</button>
                        </div><!-- /.col -->
                    </form>
                    <?php
                else:
                    ?>
                    <h2 class="text-red text-center"><i class="fa fa-exclamation-triangle"></i></h2>
                    <h4 class="text-red text-center">
                        Desculpe, este link está expirado.<br /> 
                    </h4>
                    <br />
                    <h4 class="text-center"><a href="../" >Voltar</a></h4>
                <?php
                endif;
                ?>

                <br />
                <p class="text-center">
                    <span class="loading lead"></span>
                </p>             

            </div><!-- /.login-box-body -->

            <div class="status text-center" style="padding-bottom:5px;">

            </div>
        </div><!-- /.login-box -->

        <!-- jQuery 2.2.2 -->
        <script src="<?= URL_MIN; ?>assets/plugins/jQuery/jQuery-2.2.2.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- Global Settings -->
        <script src="<?= URL_MIN . DIR_LAYOUT; ?>dist/js/global.js"></script>
        <!-- Page Scripts -->
        <script src="<?= URL_MIN; ?>assets/js/pages/jquery-usuario.js"></script>


    </body>
</html>
