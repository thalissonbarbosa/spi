<?php

namespace Lib\Classes;

use Lib\Base as Base;

/**
 * Description of Permissoes
 *
 * @author Thalisson
 */
class Permissoes extends Base\Model
{

    public function permissao($permissao, $Id = null, $Redirect = false)
    {
        if ($Id == null):
            $id = $_SESSION['user']['id'];
        else:
            $id = $Id;
        endif;

        $query = "SELECT * FROM usuarios_permissoes WHERE usuarios_id = :usuario_id";
        $this->query($query);
        $this->bind(":usuario_id", $id);
        $this->execute();
        $result = $this->result();

        if ($result[$permissao] == 1) {
            return true;
        } else {
            if ($Redirect == true):
                ?>
                <script>
                        window.location.href = '<?= URL_ROOT; ?>';
                </script>
                <?php
            else:
                return false;
            endif;
        }
    }

    public function addPermissao($idUsuario, $tipo)
    {
        $cols = "usuarios_id, imovel_cad, imovel_edit, imovel_del, fiador_cad, fiador_edit, fiador_del, locatario_cad, locatario_edit, "
                . "locatario_del, proprietario_cad, proprietario_edit, proprietario_del, visita_cad, visita_edit, visita_del, servicos_cad, "
                . "servicos_edit, servicos_del, imovel_config, atendimento_edit, atendimento_del";

        if ($tipo == "Administrador"):
            $permissoes = "1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1";
            $query = "INSERT INTO usuarios_permissoes ($cols) VALUES($idUsuario,$permissoes)";
            return $query;
        endif;
        if ($tipo == "Gerente"):
            $permissoes = "1,1,0,1,1,0,1,1,0,1,1,0,1,1,0,1,1,0,1,0,1";
            $query = "INSERT INTO usuarios_permissoes ($cols) VALUES($idUsuario,$permissoes)";
            return $query;
        endif;
        if ($tipo == "Padrao"):
            $permissoes = "1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,0";
            $query = "INSERT INTO usuarios_permissoes ($cols) VALUES($idUsuario,$permissoes)";
            return $query;
        endif;
        if ($tipo == "Corretor"):
            $permissoes = "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
            $query = "INSERT INTO usuarios_permissoes ($cols) VALUES($idUsuario,$permissoes)";
            return $query;
        endif;
    }

    public function getUser($id)
    {
        $query = "SELECT * FROM usuarios_permissoes WHERE usuarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

}
