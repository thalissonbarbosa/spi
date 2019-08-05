<?php
// Diretorio de Modals
define('DIR_MODALS', 'app/views/lte-2/_inc/modals/');

$controllers = array(
);

$actions = array(
);

// Incluir por pagina && action
$controllers_action = array(
    'imovel' => array(
        'editar' => array(
            DIR_MODALS . 'add_locatario.php',
            DIR_MODALS . 'add_proprietarios_imovel.php'
        ),
        'cadastrar' => array(
            DIR_MODALS . 'add_locatario.php',
            DIR_MODALS . 'add_proprietarios_imovel.php'
        ),
        'detalhes' => array(
            DIR_MODALS . 'add_atributos_imovel.php',
            DIR_MODALS . 'add_recursos_imovel.php',
            DIR_MODALS . 'mais_detalhes_imovel.php',
        )
    ),
    'agendamento' => array(
        'servicos' => array(
            DIR_MODALS . 'set_imovel.php'
        ),
        'visitas' => array(
            DIR_MODALS . 'set_imovel.php'
        )
    ),
    'clientes' => array(
        'locatarios' => array(
            DIR_MODALS . 'add_imovel.php',
            DIR_MODALS . 'add_fiador.php'
        ),
        'fiadores' => array(
            DIR_MODALS . 'add_locatario.php'
        ),
        'proprietarios' => array(
            DIR_MODALS . 'add_imovel.php'
        )
    )
);

// Verifica apenas a página e inclui
foreach ($controllers as $key => $value):

    if ($_GET['controller'] == $key && $_GET['id'] == ''):
        foreach ($value as $link):
            include ($link);
        endforeach;
    endif;
endforeach;

// Verifica apenas a Action e inclui
foreach ($actions as $key => $value):

    if ($_GET['action'] == $key):
        foreach ($value as $link):
            include ($link);
        endforeach;
    endif;
endforeach;

// Verifica a pagina e action para incluir
foreach ($controllers_action as $key => $value):

    if ($_GET['controller'] == $key):
        foreach ($value as $key2 => $value2):
            if ($_GET['action'] == $key2):

                foreach ($value2 as $link):

                    include ($link);

                endforeach;

            endif;
        endforeach;
    endif;
endforeach;
