
<div class="sucesso">
    <?php if ($_GET['t'] == 'edit') { ?>
        <h1>Salvo com sucesso!</h1>
        <p>Ref: <?= $_GET['ref'] ?></p>
        <a href="detalhes.php?ref=<?= $_GET['ref']; ?>">Ver</a>
    <?php } else { ?>
        <h1>Cadastrado com sucesso!</h1>
        <h3>Ref: #<?= $_GET['ref'] ?></h3>
        <a href="<?= URL_ROOT; ?>imovel/cadastrar">Cadastrar outro</a> <a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $_GET['ref']; ?>">Ver Imóvel</a>
        
    <?php } ?>

</div>

