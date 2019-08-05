<?php

namespace App\Models;

use App\Models\Config as Config;
use Lib\Base as Base;
use Lib\Classes as Classes;

/**
 * Description of pesquisar
 *
 * @author Thalisson
 */
class Pesquisar extends Base\Model
{

    public function Index()
    {
        return;
    }

    public function search()
    {
        $categoria = $_POST['categoria'];
        $tipo = $_POST['tipo'];
        $stats = $_POST['stats'];
        $ref = $_POST['ref'];
        //$endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $condominio = $_POST['condominio'];

        $preco = nFormatDB($_POST['preco']);
        if (empty($preco)) {
            $preco = "0.00";
        }
        $preco2 = nFormatDB($_POST['preco2']);
        $zona = $_POST['zona'];

        $where = array();
        // Verificando qual foi a pesquisa
        if ($ref != "") {
            $where[] = " ref LIKE '%{$ref}%'";
        }
        if ($bairro != "") {
            $where[] = " bairro LIKE '%{$bairro}%'";
        }
        if ($condominio != "") {
            $where[] = " condominio LIKE '%{$condominio}%'";
        }
        if ($zona != " ") {
            $where[] = " zona = '{$zona}'";
        }

        if ($categoria != " ") {
            $where[] = " categoria = '{$categoria}'";
        }
        if ($tipo != " ") {
            $where[] = " tipo = '{$tipo}'";
        }
        if ($stats != " ") {
            $where[] = " stats = '{$stats}'";
        } else {
            $where[] = " stats NOT IN('DESABILITADO', 'LOCADO')";
        }

        $query = "SELECT * FROM vw_imoveis";
        if ($where == true):
            $query .= ' WHERE ';
            $query .= implode(" AND ", $where);
            $query .= " AND (valor BETWEEN '{$preco}' AND '{$preco2}')";
        else:
            $query .= " AND (valor BETWEEN '{$preco}' AND '{$preco2}')";
        endif;

        $this->query($query);
        $this->execute();
        $result = $this->resultset();

        if ($this->numRows() == 0):
            echo false;
        else:
            foreach ($result as $imovel):

                $id = $imovel['id'];
                $codigo = $imovel['codigo'];
                $ref = $imovel['ref'];
                $img = Classes\CamposDefault::imgPrincipal($imovel['imagemPrincipal'], $codigo, true);
                $categoria = Classes\CamposDefault::categoria($imovel['categoria']);
                $status = Classes\CamposDefault::status($imovel['stats']);
                $condominio = $imovel['condominio'];

                $valor = nformat($imovel['valor']);

                $Categorias = new Config\Categorias_DAO();
                $cor = $Categorias->getList("WHERE categoria = '{$imovel['categoria']}'");
                $corCategoria = $cor[0]['cor'];

                $Status = new Config\Status_DAO();
                $cor = $Status->getList("WHERE stats = '{$imovel['stats']}'");
                $corStatus = $cor[0]['cor'];
                ?>
                <div class="box box-default">

                    <div class="box-header with-border">
                        <span class="box-title">
                            <?= '#' . $ref . ' - ' . $codigo?>
                        </span>
                        <span class="box-title text-olive pull-right">
                            R$ <?= $valor; ?>
                        </span>

                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">

                                <a  href="<?= URL_ROOT . "imovel/detalhes/" . $codigo; ?>">
                                    <img class="img-responsive img-rounded" src="<?= DIR_IMG . $img; ?>" style="max-width:170px" />
                                </a>

                            </div>
                            
                            <div class="col-md-10">

                                <ul class="list-group" >
                                    <li class="list-group-item no-border"  style="font-size:16px; padding:0;">
                                         
                                        <span class="text-light-blue">
                                            <?=
                                            $imovel['endereco'] . ", " . $imovel['numero'] . " - " . $imovel['bairro'] . " - " . $imovel['zona']
                                            . " - " . $imovel['cep'] . " - " . $imovel['cidade']
                                            . ' - <small class="text-olive">' . $condominio . '</small>';
                                            ?>
                                        </span>

                                    </li>

                                </ul>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corCategoria; ?>; width:150px">
                                    <?= mb_ucwords($categoria); ?>
                                </span>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corStatus; ?>; width:150px">
                                    <?= mb_ucwords($status); ?>
                                </span>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corStatus; ?>; width:150px; margin-top:5px;">
                                    <?= mb_ucwords($imovel['tipo']); ?>
                                </span>

                            </div>
                        </div> <!-- ./row -->
                    </div> <!-- ./box-body -->

                </div> <!-- ./box -->

                <?php
            endforeach;
        endif;
    }

}
