<?php

namespace Lib\Classes;

/**
 * Description of Paginacao
 *
 * Primeira call -> setPaginacao() -> retorna o LIMIT
 * Segunda call -> totalPaginas(resultado linhas) -> retorna o total de páginas
 * Terceira call -> links() -> retorna o menu de link da paginacao
 * 
 * @author Thalisson
 */
class Paginacao
{

    // número de registros por página
    public static $total_reg = "20";
    public static $limit;
    public static $total_pag;
    public static $pag_atual;
    public static $anterior;
    public static $proximo;

    public static function setPaginacao()
    {

        if (_GetInt('pag')) {
            $pag = _GetInt('pag');
        } else {
            $pag = false;
        }

        if ($pag) {
            self::$pag_atual = $pag;
        } else {
            self::$pag_atual = 1;
        }

        if (isset($_GET['limit'])):
            self::$total_reg = $_GET['limit'];
        endif;

        self::$anterior = self::$pag_atual - 1;
        self::$proximo = self::$pag_atual + 1;

        $inicio = self::$pag_atual - 1;
        $inicio = $inicio * Paginacao::$total_reg;

        self::$limit = $inicio . "," . Paginacao::$total_reg;
        return $inicio . "," . Paginacao::$total_reg;
    }

    public static function totalPaginas($Total_linhas)
    {

        // verifica o número total de páginas
        self::$total_pag = $Total_linhas / Paginacao::$total_reg;
    }

    public static function links()
    {

        $URL = new URL();
        for ($i = 1; $i <= ceil(self::$total_pag); $i++):

            $bg = '';
            if (isset($_GET['pag'])):
                if ($_GET['pag'] == $i):
                    $bg = 'style="background: #C73636"';
                endif;
            elseif ($i == 1):
                $bg = 'style="background: #C73636"';
            endif;
            ?>
            <a href="<?= $URL->URI(array('pag' => $i)); ?>" class='paginacao' <?= $bg; ?> ><?= $i; ?></a>
            <?php
        endfor;
    }

    public static function quantidades()
    {
        $URL = new URL();
        ?>
        <select style="width:60px;" onChange="this.options[this.selectedIndex].onclick()">
            <option value="10" style="padding-left:10px;" <?= (self::$total_reg == 10) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 10)); ?>'"> 10</option>
            <option value="15" style="padding-left:10px;" <?= (self::$total_reg == 15) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 15)); ?>'"> 15</option>
            <option value="20" style="padding-left:10px;" <?= (self::$total_reg == 20) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 20)); ?>'"> 20</option>
            <option value="25" style="padding-left:10px;" <?= (self::$total_reg == 25) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 25)); ?>'"> 25</option>
            <option value="30" style="padding-left:10px;" <?= (self::$total_reg == 30) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 30)); ?>'"> 30</option>
            <option value="40" style="padding-left:10px;" <?= (self::$total_reg == 40) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 40)); ?>'"> 40</option>
            <option value="50" style="padding-left:10px;" <?= (self::$total_reg == 50) ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 50)); ?>'"> 50</option>
            <option value="1000" style="padding-left:10px;" <?= (self::$total_reg == "1000") ? 'selected' : '' ?> onClick="window.location = '<?= $URL->URI(array('limit' => 1000)) ?>'"> Todos</option>
        </select>

        <?php
    }

}
