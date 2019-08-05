<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login | SPI - Sistema de Pesquisa Interna - Cabral Gama Imobiliária</title>
        <!-- Tell the browser to be responsive to screen width -->
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

    </head>

    <body class="hold-transition login-page" style="background: url('<?= DIR_IMG; ?>login-background-2019-01.png') center no-repeat;">
        <div class="login-box">
            <div class="login-logo">

                <a href="" class="mx-auto"><img src="<?= DIR_IMG; ?>logo-cabral-gama-inverse.png" style="width:80%" /></a>

            </div><!-- /.login-logo -->
            <div class="login-box-body">

                <p class="login-box-msg">Entre para iniciar sua sessão</p>
                <form id="login" action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control input-lg" name="login" placeholder="Login">
                        <i class="fa fa-user form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control input-lg" name="senha" placeholder="Senha">
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                    <div>
                        <button type="submit" class="btn bg-olive btn-block btn-lg btn-flat">Entrar</button>
                    </div><!-- /.col -->
                </form>

                <br />
                <a href="<?= URL_ROOT; ?>usuario/recuperar_senha" >Esqueci minha senha!</a>
                <span class="loading pull-right"></span>

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
