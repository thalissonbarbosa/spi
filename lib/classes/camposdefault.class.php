<?php

namespace Lib\Classes;

/**
 * Description of CamposDefault
 *
 * @author Thalisson
 */
class CamposDefault
{

    // Se não tiver número
    public static function numero($numero)
    {
        if (empty($numero)):
            return "S/N";
        else:
            return $numero;
        endif;
    }

    public static function imgPrincipal($imgPrincipal, $imovel, $thumb = false)
    {
        // Se não tiver imagem
        if ($imgPrincipal != 'default.png'):
            if ($thumb == true):
                $imgPrincipal = explode(".", $imgPrincipal);
                $imgPrincipal = $imgPrincipal[0] . "-thumb.jpg";
            endif;
            return "imoveis/" . $imovel . "/" . $imgPrincipal;
        else:
            return $imgPrincipal;
        endif;
    }

    public static function taxaCond($taxaCond)
    {
        if ($taxaCond == 0.00):
            return "";
        else:
            return "R$ " . nformat($taxaCond);
        endif;
    }

    public static function categoria($categoria)
    {
        // Se não houver categoria
        if (empty($categoria)):
            return "Sem Categoria...";
        else:
            return $categoria;
        endif;
    }

    public static function status($status)
    {
        // Se não houver status
        if (empty($status)):
            return "Sem Status...";
        else:
            return $status;
        endif;
    }

    public static function cor($cor)
    {
        // Se não houver cor da Categoria a cor padrão é #333
        if (empty($cor)):
            return "333";
        else:
            return $cor;
        endif;
    }

}
