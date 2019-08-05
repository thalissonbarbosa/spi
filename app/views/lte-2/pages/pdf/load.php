<?php

use Dompdf\Dompdf;

if (isset($_POST['output'])) {

    // Pegando os dados da pagina html
    $html = file_get_contents($_POST['output']);

    // instanciando e usando a class Dompdf
    $dompdf = new Dompdf();

    // Carregando a pagina html
    $dompdf->loadHtml($html);

    // Tamanho e Orientação da página
    $dompdf->setPaper('A4', 'landscape');

    // Renderiza Html para Pdf
    $dompdf->render();

    // Output o pdf para o browser
    $dompdf->stream('lista_imoveis', array('Attachment' => 0));
} else {
    header("Location: " . URL_ROOT);
}