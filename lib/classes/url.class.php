<?php

namespace Lib\Classes;

/**
 * Função URI para setar os gets de busca
 *
 * @author Thalisson
 */
class URL
{

    public function URI($array = array())
    {

        foreach ($_GET as $key => $value):
            if ($key != 'controller' AND $key != 'action' AND $key != 'id'):

                if (!array_key_exists($key, $array)):

                    $array[$key] = $value;
                endif;

            endif;
        endforeach;

        return '?' . http_build_query($array);
    }

}
