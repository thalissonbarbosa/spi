<?php
/* CSS */
$dataTables = array(
    'css' => URL_MIN . 'assets/plugins/datatables/media/css/dataTables.bootstrap.css',
    'css2' => URL_MIN . 'assets/plugins/datatables/extensions/buttons/css/buttons.dataTables.min.css'
);

$dataPicker = array(
    'css' => URL_MIN . 'assets/plugins/datepicker/css/bootstrap-datepicker3.min.css'
);

$colorPicker = array(
    'css' => URL_MIN . 'assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'
);

$fancybox = array(
    'css' => URL_MIN . 'assets/plugins/fancybox/source/jquery.fancybox.css'
);

$controllers = array(
    'agendamento' => $dataTables,
    'clientes' => $dataTables
);

$controllers_action = array(
    'imovel' => array(
        'detalhes' => array(
            $fancybox,
            array (
                'css' => URL_MIN . 'assets/plugins/icheck/skins/minimal/purple.css'
            )
        ),
        'lista' =>
        array(
            $dataTables
        )
    ),
    'agendamento' => array(
        'visitas' =>
        array(
            $dataPicker
        ),
        'servicos' =>
        array(
            $dataPicker
        )
    ),
    'atendimento' => array(
        '' => array(
            $dataTables
        )
    ),
    'configuracoes' => array(
        'categorias' => array(
            $colorPicker
        ),
        'status' => array(
            $colorPicker
        ),
        'usuarios' => array(
            array (
                'css' => URL_MIN . 'assets/plugins/icheck/skins/minimal/purple.css'
            )
        )
    )
);

/*
 * Percorre os controllers e inclui o script
 * Scripts que contem em todas as suas filhas
 */
foreach ($controllers as $key => $value):

    if ($_GET['controller'] == $key && $_GET['id'] == ''):
        foreach ($value as $link):
            ?>
            <link rel="stylesheet" href="<?= $link ?>">
            <?php
        endforeach;
    endif;

endforeach;

/*
 * Percorre as Actions (filhas) e inclui o script
 * Scripts separados por Actions (unicos)
 */
foreach ($controllers_action as $key => $value):

    if ($_GET['controller'] == $key):
        foreach ($value as $key2 => $value2):
            if ($_GET['action'] == $key2):

                foreach ($value2 as $key3 => $value3):
                    foreach ($value3 as $key4 => $link):
                        ?>
                        <link rel="stylesheet" href="<?= $link ?>">
                        <?php
                    endforeach;
                endforeach;

            endif;
        endforeach;
    endif;

endforeach;
