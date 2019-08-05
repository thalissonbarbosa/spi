<?php

namespace Lib\Classes;

use Lib\Base as Base;
/**
 * Classe com métodos para proteção de campos de formulários
 * Input geral, login, email, senha
 * @author Thalisson Barbosa
 */
class FiltroInput extends Base\Model
{

    public static $Errors = array();

    // Verifica Errors, se houver Exibi e Encerra a aplicação
    function __construct()
    {
        $this->errors();
    }

    /*
     * $Input = contendo o texto
     * $Campo = nome do campo
     * Verifica se o campo contém caracteres inválidos
     * Não pode - \/ ' { } [ ] ` ´
     */

    public static function ref($Input)
    {
 
        if (!empty($Input)):
            if (!preg_match('/^[a-zA-Z0-9+]+$/', $Input)):

                array_push(self::$Errors, "► Ref # está com caracteres inválidos!<br />");
                return $Input;
            else:
                return mb_ucwords($Input);
            endif;
        else:
            return $Input;
        endif;
    }

    public static function input($Input, $Campo)
    {

        if (!empty($Input)):
            if (!preg_match('/^[a-zA-Z0-9-.\/,áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇº() +]+$/', $Input)):

                array_push(self::$Errors, "► {$Campo} está com caracteres inválidos!<br />");
                return $Input;
            else:
                return mb_ucwords($Input);
            endif;
        else:
            return $Input;
        endif;
    }

    /*
     * Verifica se é uma data correta
     */

    public static function data($Data, $Campo)
    {

        if ($Data != null):

            $explode = explode('/', $Data);
            $mes = $explode[1];
            $dia = $explode[0];
            $ano = $explode[2];

            if (checkdate($mes, $dia, $ano)):
                return $Data;
            else:
                array_push(self::$Errors, "► {$Campo} inválida.<br />");
            endif;
        endif;
    }

    /*
     * Verificar campo do login
     * Só pode ter números e letras
     * Entre 5 e 20 caracteres
     */

    public static function login($Input, $Page = null)
    {

        if (empty($Input)):

            array_push(self::$Errors, "► Digite o Login.");
        elseif ($Page == null):
            // Se conter caracteres diferentes de Numeros, Letras, _ e .
            if (preg_match('/[^[:alnum:]_.]/', $Input)):

                array_push(self::$Errors, "► Login está com caracteres inválidos!");
            // Menor do que 5 ou maior que 20
            elseif (strlen($Input) < 5 || strlen($Input) > 20):

                array_push(self::$Errors, "► Login precisa ter entre 5 e 20 caracteres");
            else:
                return $Input;
            endif;
        else:
            return $Input;

        endif;
    }

    public static function senha($Input, $Page = null)
    {

        if (empty($Input)):

            array_push(self::$Errors, "► Digite a Senha.");

        // Se o input for o do login, não verifica os seguintes errors
        elseif ($Page == null):
            if (preg_match('/[^[:alnum:]_.*-]/', $Input)):

                array_push(self::$Errors, "► Senha está com caracteres inválidos!<br />");
            elseif (strlen($Input) <= 5 || strlen($Input) >= 20):

                array_push(self::$Errors, "► Senha deve ter entre 5 e 20 caracteres<br />");
            endif;

        endif;
        return $Input;
    }

    /*
     * Verifica se é um formato de email válido
     */

    public static function email($Email)
    {

        if (!empty($Email)):
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)):

                array_push(self::$Errors, "► E-mail inválido!");
            else:
                return $Email;

            endif;
        else:
            return $Email;
        endif;
    }

    public static function campoVazio($Input, $Campo)
    {
        
        if (empty($Input) || $Input == '0.00'):
            array_push(self::$Errors, "► {$Campo} não pode ser vazio.<br />");
        endif;
    }

    public static function campoVazioData($Input)
    {

        if ($Input == ''):
            array_push(self::$Errors, "► Data não pode ser vazio!<br />");
        else:
            return $Input;
        endif;
    }

    /*
     * Confere se contém os errors
     * Se conter errors apresenta mensagem e para a aplicação
     */

    private function errors()
    {

        if (count(self::$Errors) > 0):

            $error = "<span class='red'>";

            foreach (self::$Errors as $e):

                $error .= $e;

            endforeach;

            $error .="</span>";

            Messages::setMsg($error, 'error');
            Messages::getMsg();
            exit();

        endif;
    }

}
