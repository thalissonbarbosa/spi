<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

        <title>SPI - SISTEMA DE PESQUISA INTERNA - CABRAL GAMA IMOBILIÁRIA</title>

        <link rel="stylesheet" href="<?= URL_ROOT; ?>assets/css/pdf_layout.css" />

        <style>
            body{
                font-family: 'Helvetica';
            }
        </style>

    </head>

    <body>

        <header>
            <img src="<?= DIR_IMG; ?>logo2.png" class="logo" />
        </header>

        <section>
            <?php
            $page = $_GET['pdf_page'];

            if ($page == 'imovel_lista'):

                include ('_imovel_lista.php');

            endif;
            ?>
        </section>
        <footer>
            <span>
            </span>
        </footer>
    </body>
</html>