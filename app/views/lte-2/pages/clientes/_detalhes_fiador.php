<?php

use App\Models\Imovel as Imovel;
use App\Models\Clientes as Clientes;

$id = _GetInt('f');

$Fiador = new Clientes\Fiadores_DAO();
$FiadorAssoc = new Imovel\Fiadores_DAO();
$Locatarios = new Clientes\Locatarios_DAO();

$result = $Fiador->get($id);
$repres_display = (empty($result['representante'])) ? 'display: none;' : '';

$empresa = $Fiador->getEmpresa($id);
$empresa_display = (!$empresa) ? 'display: none;' : '';
$empresa_endereco = $empresa['rua'] . " , " . $empresa['numero'] . " , " . $empresa['bairro'] . " , " . $empresa['cep']
        . " , " . $empresa['zona'] . " , " . $empresa['cidade'];

$locatario = $FiadorAssoc->getAssoc("WHERE cl_fiadores_id = '{$id}'");
?>

<div class="box">
    <div class="box-header with-border">
        <span class="box-title">Detalhes</span>

        <?php
        if (permissao('fiador_edit')):
            ?>
            <div class="box-tools pull-right">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle lead text-purple" data-toggle="dropdown"><i class="fa fa-gear"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#modal-mais-detalhes"><i class="fa fa-pencil-square"></i> Editar</a></li>
                    </ul>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>

    <div class="box-body">

        <ul class="list-group">

            <div id="pessoal">
                <li class="list-group-item bg-light-gray">Pessoal</li>

                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Nome:</strong></div>
                    <span class="list-text"><?= $result['nome'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Endereço:</strong></div>
                    <span class="list-text"><?= $result['endereco'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>RG:</strong></div>
                            <span class="list-text"><?= strtoupper($result['rg']); ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>CPF:</strong></div>
                            <span class="list-text"><?= $result['cpf'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Contato:</strong></div>
                            <span class="list-text"><?= $result['contato'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Email:</strong></div>
                            <span class="list-text"><?= $result['email'] ?></span>
                        </div>
                    </div>
                </li>

                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Estado Civil:</strong></div>
                            <span class="list-text"><?= $result['estado_civil'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Data Nascimento:</strong></div>
                            <span class="list-text"><?= $result['data_nasc'] ?></span>
                        </div>
                    </div>   
                </li>
                <li class="list-group-item clearfix no-padding" style="<?= $repres_display; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Representante:</strong></div>
                            <span class="list-text"><?= $result['representante'] ?></span>
                        </div>
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Rep. Contato:</strong></div>
                            <span class="list-text"><?= $result['rep_contato'] ?></span>
                        </div>
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Rep. Email:</strong></div>
                            <span class="list-text"><?= $result['rep_email'] ?></span>
                        </div>
                    </div>   
                </li>
            </div><!-- ./pessoal -->

            <div id="profissional">
                <li class="list-group-item bg-light-gray">Profissional</li>

                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Profissão:</strong></div>
                    <span class="list-text"><?= $result['profissao'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Firma:</strong></div>
                    <span class="list-text"><?= $result['prof_firma'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Endereço:</strong></div>
                    <span class="list-text"><?= ($result['prof_endereco'] == ' ,  ,  ,  ,  , ') ? '' : $result['prof_endereco']; ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Função:</strong></div>
                    <span class="list-text"><?= $result['prof_funcao'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Contato:</strong></div>
                    <span class="list-text"><?= $result['prof_telefone'] ?></span>
                </li>
            </div><!-- ./profissional -->

            <div id="conjuge">
                <li class="list-group-item bg-light-gray">Cônjuge</li>

                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Nome:</strong></div>
                    <span class="list-text"><?= $result['conjuge'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>RG:</strong></div>
                            <span class="list-text"><?= strtoupper($result['conj_rg']); ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>CPF:</strong></div>
                            <span class="list-text"><?= $result['conj_cpf'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Data Nascimento:</strong></div>
                    <span class="list-text"><?= $result['conj_nasc'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Profissão:</strong></div>
                    <span class="list-text"><?= $result['conj_profissao'] ?></span>
                </li>
            </div><!-- ./conjuge -->

            <div id="empresa" style="<?= $empresa_display; ?>">
                <li class="list-group-item bg-light-gray">Empresa</li>

                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>CNPJ:</strong></div>
                    <span class="list-text"><?= $empresa['cnpj'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Inscrição Estadual:</strong></div>
                    <span class="list-text"><?= $empresa['inscricao_estadual'] ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="list-title bg-light-blue-active"><strong>Endereço:</strong></div>
                    <span class="list-text"><?= ($empresa_endereco == ' ,  ,  ,  ,  , ') ? '' : $empresa_endereco ?></span>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Razão Social:</strong></div>
                            <span class="list-text"><?= $empresa['razao_social']; ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Nome Fantasia:</strong></div>
                            <span class="list-text"><?= $empresa['nome_fantasia'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Ramo de Atividade:</strong></div>
                            <span class="list-text"><?= $empresa['ramo'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Sede:</strong></div>
                            <span class="list-text"><?= $empresa['sede'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Data Abertura:</strong></div>
                            <span class="list-text"><?= $empresa['data_abertura'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Controle Acionário:</strong></div>
                            <span class="list-text"><?= $empresa['controle_acionario'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Capital Aberto:</strong></div>
                            <span class="list-text"><?= $empresa['capital_aberto'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Capital Social:</strong></div>
                            <span class="list-text"><?= $empresa['capital_social'] ?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item clearfix no-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-title bg-light-blue-active"><strong>Contato:</strong></div>
                            <span class="list-text"><?= $empresa['contato'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="list-title bg-light-blue-active"><strong>Email:</strong></div>
                            <span class="list-text"><?= $empresa['email'] ?></span>
                        </div>
                    </div>
                </li>
            </div><!-- ./empresa -->

            <div id="imovel">
                <li class="list-group-item bg-light-gray">Locatários Associados</li>
                <li class="list-group-item clearfix">
                    <ul class="list-group" style="float:left; margin-left: 10px;">
                        <?php
                        if ($locatario):
                            foreach ($locatario as $data):
                                // dados do imovel
                                $detalhes = $Locatarios->get($data['cl_locatarios_id']);
                                ?>
                                <li class="list-group-item">
                                    <a href="<?= URL_ROOT; ?>clientes/locatarios/detalhes?l=<?= $detalhes['id'] ?>" target="_blank"><?= $detalhes['nome'] ?></a>
                                </li>
                                <?php
                            endforeach;
                        else:
                            echo '<span class="list-text">Sem locatário</span>';
                        endif;
                        ?>
                    </ul>
                </li>
            </div> <!-- ./locatarios -->
        </ul> 
    </div>
</div>
