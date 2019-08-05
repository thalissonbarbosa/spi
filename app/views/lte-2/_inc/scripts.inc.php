<?php
// Script dataTables
$dataTables = array(
    'js' => URL_MIN . 'assets/plugins/datatables/media/js/jquery.dataTables.min.js',
    'js2' => URL_MIN . 'assets/plugins/datatables/media/js/dataTables.bootstrap.min.js',
    'js3' => URL_MIN . 'assets/plugins/datatables/extensions/buttons/js/dataTables.buttons.min.js',
    'js4' => URL_MIN . DIR_LAYOUT . 'dist/js/dataTables.js'
);
// Script Buttons Print
$dataPrint = array(
    'js' => URL_MIN . 'assets/plugins/datatables/extensions/buttons/js/buttons.print.min.js',
);
// Script Buttons PDF
$dataPdf = array(
    'js' => URL_MIN . 'assets/plugins/datatables/extensions/buttons/js/buttons.html5.min.js',
    'js2' => URL_MIN . 'assets/plugins/pdfmake/pdfmake.min.js',
    'js3' => URL_MIN . 'assets/plugins/pdfmake/vsf_fonts.js'
);
// Script DataPicker
$dataPicker = array(
    'js' => URL_MIN . 'assets/plugins/datepicker/js/bootstrap-datepicker.min.js',
    'js2' => URL_MIN . 'assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.min.js',
    'js3' => URL_MIN . DIR_LAYOUT . 'dist/js/datePicker.js'
);
// Script ColorPicker
$colorPicker = array(
    'js' => URL_MIN . 'assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js',
    'js2' => URL_MIN . DIR_LAYOUT . 'dist/js/colorPicker.js'
);
// Script Fancybox
$fancybox = array(
    'js' => URL_MIN . 'assets/plugins/fancybox/source/jquery.fancybox.pack.js'
);
// Script iCheck
$icheck = array(
    'js' => URL_MIN . 'assets/plugins/icheck/icheck.min.js',
    'js2' => URL_MIN . DIR_LAYOUT . 'dist/js/icheck.js',
);
// Script CEP search
$cep = array(
    'js' => URL_MIN . 'assets/plugins/cep/cep.js'
);


/*
 * Paginas
 */
$controllers = array(
    'agendamento' =>
    array(
        $dataTables, $dataPicker
    ),
    'clientes' =>
    array(
        $dataTables,
        $dataPicker
    ),
    'atendimento' =>
    array(
        array('js' => URL_MIN . 'assets/js/pages/jquery-atendimento.js')
    ),
    'pesquisar' =>
    array(
        array('js' => URL_MIN . 'assets/js/pages/jquery-pesquisar.js')
    ),
    'configuracoes' =>
    array(
        array('js' => URL_MIN . 'assets/js/pages/jquery-configuracoes.js')
    )
);

/*
 * Paginas Actions
 */

$controllers_action = array(
    'imovel' => array(
        'detalhes' => array(
            $fancybox,
            array(
                'js' => URL_MIN . DIR_LAYOUT . 'dist/js/caption.js',
                'js2' => URL_MIN . 'assets/js/pages/jquery-imovel-detalhes.js',
                'js3' => URL_MIN . 'assets/js/pages/jquery-galeria.js',
                'js4' => URL_MIN . 'assets/plugins/waitingfor/jquery.waitingfor.js'
            ),
            $icheck
        ),
        'cadastrar' => array(
            array(
                'js' => URL_MIN . 'assets/js/pages/jquery-imovel.js'
            ),
            $cep
        ),
        'editar' => array(
            array(
                'js' => URL_MIN . 'assets/js/pages/jquery-imovel.js'
            ),
            $cep
        ),
        'lista' =>
        array(
            $dataTables, $dataPrint, $dataPdf
        )
    ),
    'atendimento' => array(
        '' => array(
            $dataTables
        )
    ),
    'agendamento' => array(
        'visitas' =>
        array(
            array('js' => URL_MIN . 'assets/js/pages/jquery-agendamento-visitas.js')
        ),
        'servicos' =>
        array(
            array('js' => URL_MIN . 'assets/js/pages/jquery-agendamento-servicos.js')
        )
    ),
    'clientes' => array(
        'locatarios' => array(
            array(
                'js' => URL_MIN . 'assets/js/pages/jquery-locatarios.js',
                'js2' => URL_MIN . 'assets/js/pages/jquery-clientes.js'
            ),
            $cep
        ),
        'proprietarios' => array(
            array(
                'js' => URL_MIN . 'assets/js/pages/jquery-proprietarios.js',
                'js2' => URL_MIN . 'assets/js/pages/jquery-clientes.js'
            ),
            $cep
        ),
        'fiadores' => array(
            array(
                'js' => URL_MIN . 'assets/js/pages/jquery-fiadores.js',
                'js2' => URL_MIN . 'assets/js/pages/jquery-clientes.js'
            ),
            $cep
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
            $icheck
        )
    ),
    'usuario' => array(
        '' => array(
            array('js' => URL_MIN . 'assets/js/pages/jquery-usuario.js?v=3.0')
        )
    )
);
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
                        <script src="<?= $link ?>"></script>
                        <?php
                    endforeach;
                endforeach;

            endif;
        endforeach;
    endif;

endforeach;

/*
 * Percorre os controllers e inclui o script
 * Scripts que contem em todas as suas filhas
 */
foreach ($controllers as $key => $value):

    if ($_GET['controller'] == $key):

        foreach ($value as $array):
            foreach ($array as $tipo => $link):
                ?>
                <script src="<?= $link ?>"></script>
                <?php
            endforeach;
        endforeach;

    endif;

endforeach;


