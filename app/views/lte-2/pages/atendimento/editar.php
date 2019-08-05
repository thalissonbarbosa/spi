<?php

use Lib\Classes as Classes;
use App\Models as Models;

$id = _GetInt('id');

if (!permissao('atendimento_edit')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Atendimento = new Models\Atendimento();
$result = $Atendimento->get($id);

$nome = $result['nome'];
$email = strtolower($result['email']);
$tel = $result['tel'];
$tel_comercial = $result['tel_comercial'];
$conheceu = $result['conheceu'];
$tipo = $result['tipo'];
$interesse = $result['interesse'];
$imovel_categoria = explode(" - ", $result['imovel_categoria']);
$valor_de = nformat($result['valor_de']);
$valor_ate = nformat($result['valor_ate']);
$zona = explode(" - ", $result['zona']);
$obs = mb_ucfirst(mb_tolower(stripslashes($result['obs'])));
$usuario = $result['usuario'];
$date = date_format(new DateTime($result['data']), 'd/m/Y H:i');
$date = explode(" ", $date);

if ($interesse != "Imóvel") {
    $imovel_options_display = "style='display:none;'";
}else{
    $imovel_options_display = "";
}
?>

<div class="box box-default">

    <div class="box-header">
        <span class="box-title">Atendimento <a href="<?= URL_ROOT; ?>atendimento/detalhes/<?= $id; ?>">#<?= str_pad($id, 4, 0, STR_PAD_LEFT); ?></a> 

        </span>
    </div>

    <form id="edit_atendimento" role="form" method="post" action="">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="obrigatorio">Nome</label>
                        <input type="text" value="<?= $nome; ?>" class="form-control" name="nome" required />
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" value="<?= $email; ?>" class="form-control" name="email"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone/Celular</label>
                        <input type="text" value="<?= $tel; ?>" class="form-control tel" name="tel"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone/Comercial</label>
                        <input type="text" value="<?= $tel_comercial; ?>" class="form-control tel" name="tel_comercial" />
                    </div>
                    <div class="form-group">
                        <label>Como Conheceu</label>
                        <select class="form-control" name="conheceu">
                            <option value="Site" <?= ($conheceu == "Google") ? "selected" : ""; ?>>Site</option><option value="Google">Google</option>
                            <option value="Indicação" <?= ($conheceu == "Indicação") ? "selected" : ""; ?>>Indicação</option>
                            <option value="Jornal" <?= ($conheceu == "Jornal") ? "selected" : ""; ?>>Jornal</option>
                            <option value="Outro" <?= ($conheceu == "Outro") ? "selected" : ""; ?>>Outro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control no-resize" name="obs" style="height: 100px"><?= $obs; ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="obrigatorio">Interesse</label>
                        <select name="interesse" class="form-control">
                            <option value="Imóvel" <?= ($interesse == "Imóvel") ? "selected" : ""; ?> onClick="$('.imovel-options').show();">Imóvel</option>
                            <option value="Avaliação" <?= ($interesse == "Avaliação") ? "selected" : ""; ?> onClick="$('.imovel-options').hide();">Avaliação</option>
                            <option value="Consultoria" <?= ($interesse == "Consultoria") ? "selected" : ""; ?> onClick="$('.imovel-options').hide();">Consultoria</option>
                            <option value="Despachante" <?= ($interesse == "Despachante") ? "selected" : ""; ?> onClick="$('.imovel-options').hide();">Despachante</option>
                        </select>
                    </div>
                    <div class="imovel-options" <?= $imovel_options_display; ?>>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="imovel_tipo">
                                <?php
                                // @table @option @value @selected @orderBy @Where
                                listaOption('config_tipo', 'tipo', 'value', $tipo, 'ORDER BY tipo ASC', null);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="obrigatorio">Categoria</label>
                            <select class="form-control" name="imovel_categoria[]" style="height: 100px" multiple>
                                <option value="" selected style="display: none"></option>
                                <?php
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_categoria', 'categoria', 'value', $imovel_categoria, 'ORDER BY categoria ASC', null);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>De</label>
                            <input type="text" value="<?= $valor_de; ?>" class="form-control text-olive valor" name="imovel_valor_de" />
                        </div>
                        <div class="form-group">
                            <label class="obrigatorio">Até</label>
                            <input type="text" value="<?= $valor_ate; ?>" class="form-control text-olive valor" name="imovel_valor_ate"  />
                        </div>
                        <div class="form-group">
                            <label>Zona</label>
                            <select class="form-control" name="imovel_zona[]" style="height: 100px" multiple>
                                <option value="Qualquer" <?= ($zona[0] == 'Qualquer' || $zona[0] == '') ? 'selected' : '' ?>>Qualquer</option>
                                <?php
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_zonas', 'zona', 'value', $zona, 'ORDER BY id ASC', null);
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div> <!-- ./row -->
        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input type="hidden" name="id" value="<?= $id; ?>" />
            <input type="submit" class="btn btn-flat btn-lg bg-olive col-sm-2" value="Salvar" />
            <input type="button" class="btn btn-flat btn-lg bg-red col-sm-2" style="margin-left:10px" value="Cancelar" onClick="window.location.href = '<?= URL_ROOT; ?>atendimento/'" />
        </div>
    </form>
</div> <!-- ./box -->