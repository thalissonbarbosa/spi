<?php

namespace Lib\Classes;

use Lib\Base as Base;
use Lib\Classes as Classes;

class Listas extends Base\Model
{
    /*
     * Lista de Options do Select
     * @table   -> tabela a procurar        NOT NULL
     * @option  -> opção a exibir no option NOT NULL
     * @value   -> value do option          NULL = id
     * @select  -> se está selecionado      NULL
     * @order   -> order by da consulta     NULL = ORDER BY id DESC
     * @where   -> where da consulta        NULL
     */

    public function listaOption($table, $option, $Value = null, $select = null, $order = null, $where = null)
    {

        if ($order == null) {
            $orderBy = "ORDER BY id DESC";
        } else {
            $orderBy = $order;
        }

        if ($where == null) {
            $where = '';
        } else {
            $where = $where;
        }

        $query = "SELECT * FROM $table $orderBy $where";
        $this->query($query);
        $this->execute();
        $result = $this->resultSet();
        $linha = $this->numRows();

        if ($linha == 0):
            ?> <option disabled selected>Sem cadastro...</option> <?php
        else:
            foreach ($result as $r):

                if ($Value == null):
                    $value = $r['id'];
                else:
                    $value = $r[$option];
                endif;

                $select_compare = $option;

                if (is_array($select)) {
                    foreach ($select as $sel):
                        if (mb_tolower($sel) == mb_tolower($r[$option])):
                            $selected = true;
                            break;
                        else:
                            $selected = false;
                        endif;
                    endforeach;
                }else {
                    if ($select != null):
                        if (mb_tolower($select) == mb_tolower($r[$select_compare])):
                            $selected = true;
                        else:
                            $selected = false;
                        endif;
                    else:
                        $selected = false;
                    endif;
                }

                if ($selected) {
                    $selected = "selected";
                } else {
                    $selected = null;
                }
                ?>
                <option value="<?= $value; ?>" <?= $selected; ?> ><?= mb_ucwords($r[$option]); ?></option>
                <?php
            endforeach;
        endif;
    }

    public function listaCategoriasFiltro()
    {

        $this->query("SELECT * FROM config_categoria ORDER BY categoria");
        $this->execute();

        if ($this->numRows() == 0):
            ?> <option disabled selected>Sem cadastro...</option> <?php
            exit();
        endif; // se não tiver cadastro, exibe isto

        foreach ($this->resultSet() as $data):
            $categoria = mb_tolower($data['categoria']);
            $select = "";
            if (isset($_GET['c'])):
                if ($_GET['c'] == $categoria):
                    $select = "selected";
                endif;
            endif;
            $URL = new Classes\URL();
            ?>
            <option <?= $select; ?> onClick="location.href = '<?= $URL->URI(array('c' => $categoria)); ?>'" ><?= mb_ucwords($categoria); ?></option>
            <?php
        endforeach;
    }

    public function listaTiposFiltro()
    {

        $this->query('SELECT * FROM config_tipo ORDER BY tipo');
        $this->execute();

        if ($this->numRows() == 0):
            ?> <option disabled selected>Sem cadastro...</option> <?php
            exit();
        endif;

        foreach ($this->resultset() as $tipo):
            $tipo = mb_tolower($tipo['tipo']);
            $select = "";
            if (isset($_GET['t'])):
                if ($_GET['t'] == $tipo):
                    $select = "selected";
                endif;
            endif;
            $URL = new Classes\URL();
            ?>
            <option <?= $select; ?> onClick="location.href = '<?= $URL->URI(array('t' => $tipo)); ?>'"><?= mb_ucwords($tipo); ?></option>
            <?php
        endforeach;
    }

    public function listaStatusFiltro()
    {

        $this->query('SELECT * FROM config_stats ORDER BY stats');
        $this->execute();

        if ($this->numRows() == 0):
            ?> <option disabled selected>Sem cadastro...</option> <?php
            exit();
        endif;

        foreach ($this->resultSet() as $stats):
            $stats = mb_tolower($stats['stats']);
            $select = "";
            if (isset($_GET['s'])) {
                if ($_GET['s'] == $stats) {
                    $select = "selected";
                }
            }
            $URL = new Classes\URL();
            ?>
            <option <?= $select; ?> onClick="location.href = '<?= $URL->URI(array('s' => $stats)); ?>'"><?= mb_ucwords($stats); ?></option>
            <?php
        endforeach;
    }

}
