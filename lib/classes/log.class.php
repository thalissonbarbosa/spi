<?php

namespace Lib\Classes;

use Lib\Base as Base;

/**
 * Description of Log
 *
 * @author Thalisson
 */
class Log extends Base\Model
{

    public function sistema_log($Texto, $Usuario = null)
    {

        if (isset($_SERVER['HTTP_CLIENT_IP'])):
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])):
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_X_FORWARDED'])):
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])):
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_FORWARDED'])):
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        elseif (isset($_SERVER['REMOTE_ADDR'])):
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else:
            $ipaddress = 'UNKNOWN';
        endif;

        // Definindo hora do brasil
        date_default_timezone_set("Etc/GMT+3");
        $data = date("Y/m/d");
        $hora = date("H:i:s");
        $texto = addslashes($Texto);

        $query = "INSERT INTO sistema_log(usuario, data, hora, mensagem, ip) VALUES (:usuario, :data, :hora, :texto, :ipaddress)";

        $this->query($query);
        $this->bind(":usuario", $_SESSION['user']['nome']);
        $this->bind(":data", $data);
        $this->bind(":hora", $hora);
        $this->bind(":texto", $texto);
        $this->bind(":ipaddress", $ipaddress);
        $this->execute();
    }

    public function getLog()
    {
        $query = "SELECT * FROM sistema_log ORDER BY id DESC LIMIT 100";

        $this->query($query);
        $this->execute();
        return $this->resultset();
    }

}
