<?php
if ($_GET['t'] == '404'):
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
                <br />
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Página não encontrada.</h3>
                <p>
                    Nós não conseguimos encontrar a página que você está procurando.
                    Por favor, contate o <strong><a href="<?= URL_ROOT; ?>suporte/">suporte</a></strong>
                    ou volte à <a href="<?= URL_ROOT; ?>"><strong>página principal.</strong></a>
                </p>
                
            </div><!-- /.error-content -->
        </div><!-- /.error-page -->
    </section><!-- /.content -->
    <?php

endif;