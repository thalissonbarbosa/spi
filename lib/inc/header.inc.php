<link rel="shortcut icon" href="<?= URL_ROOT; ?>assets/img/favicon.png">

<link rel="stylesheet" href="<?= URL_ROOT; ?>assets/css/style.css" type="text/css">
<link rel="stylesheet" href="<?= URL_ROOT; ?>assets/css/jquery-ui.css" />

<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery-1.11.3.min.js"></script>
<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery-ui.min.js"></script>
<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery.maskMoney.js"></script>
<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery.maskedinput.min.js"></script>
<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery-global.js"></script>
<script language="javascript" src="<?= URL_ROOT; ?>assets/js/jquery.safeform.js"></script>
<?php
$includes_controller = array(
    "atendimento" => array(
        "js" => 'pages/jquery-atendimento.js'
    ),
    "agendamento" => array(
        "css" => 'glDatePicker.default.css',
        "js" => 'pages/jquery-agendamento.js',
        "js1" => 'glDatePicker.min.js'
    ),
    "imovel" => array(
        "js" => 'pages/jquery-imovel.js'
    ),
    "clientes" => array(
        "js" => 'pages/jquery-clientes.js',
        "js1" => 'cep.js'
    ),
    "pesquisar" => array(
        "js" => 'pages/jquery-pesquisar.js'
    ),
    "configuracoes" => array(
        "js" => 'pages/jquery-configuracoes.js'
    ),
    "usuario" => array(
        "js" => 'pages/jquery-usuario.js'
    )
);

$includes_action = array(
    "cadastrar" => array(
        "js" => 'cep.js'
    ),
    "proprietarios" => array(
        "js" => 'pages/jquery-proprietarios.js',
    ),
    "locatarios" => array(
        "js" => 'pages/jquery-locatarios.js',
    ),
    "fiadores" => array(
        "js" => 'pages/jquery-fiadores.js',
    ),
    "detalhes" => array(
        "js" => 'pages/jquery-galeria.js',
        "js2" => 'jquery.uploadfile.js',
        "js3" => 'fancybox/source/jquery.fancybox.pack.js?v=2.1.5',
        "css" => 'js/fancybox/source/jquery.fancybox.css?v=2.1.5'
    ),
    "categorias" => array(
        "js" => 'colpick.js',
        "css" => 'css/colpick.css'
    ),
    "status" => array(
        "js" => 'colpick.js',
        "css" => 'css/colpick.css'
    )
);

foreach ($includes_controller as $key => $inc):

    if ($_GET['controller'] == $key):

        foreach ($inc as $tipo => $arquivo):
            if ($tipo == "css"):
                ?>
                <link rel="stylesheet" href="<?= URL_ROOT; ?>assets/css/<?= $arquivo; ?>">
                <?php
            else:
                ?>
                <script language="javascript" src="<?= URL_ROOT; ?>assets/js/<?= $arquivo; ?>"></script>
            <?php
            endif;
        endforeach;

    endif;

endforeach;

foreach ($includes_action as $key => $inc):

    if ($_GET['action'] == $key):

        foreach ($inc as $tipo => $arquivo):
            if ($tipo == "css"):
                ?>
                <link rel="stylesheet" href="<?= URL_ROOT; ?>assets/<?= $arquivo; ?>" >
                <?php
            else:
                ?>
                <script language="javascript" src="<?= URL_ROOT; ?>assets/js/<?= $arquivo; ?>"></script>
            <?php
            endif;
        endforeach;

    endif;

endforeach;
