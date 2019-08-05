<?php
$Log = new Lib\Classes\Log();
$result = $Log->getLog();
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-history"></i> Logs</span>

        <?php
        if ($_SESSION['user']['login'] == 'developer'):
            ?>
            <a href="<?= URL_ROOT; ?>logs/limpar" class="btn btn-flat bg-red pull-right"><i class="fa fa-trash"></i> Limpar log</a>
            <?php
        endif;
        ?>
    </div>
    <div class="box-body">

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Usuário</th>
                    <th>Data</th>
                    <th>Mensagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $log):
                    $data = dformat($log['data']);
                    $hora = hformat($log['hora']);
                    $mensagem = $log['mensagem'];
                    ?>
                    <tr>
                        <td><strong># <?= $log['id']; ?></strong></td>
                        <td><?= $log['usuario']; ?></td>
                        <td><?= $data . ' às ' . $hora; ?></td>
                        <td><?= stripslashes($mensagem); ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>