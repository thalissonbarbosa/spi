<?php

namespace App\Models\Imovel;

use Lib\Base as Base;
use Lib\Classes as Classes;

/**
 * Description of galeria_DAO
 *
 * @author Thalisson
 */
class Galeria_DAO extends Base\Model
{

    public function getListFrom($imovel_codigo)
    {
        // Buscando imagens do imóvel
        $query = "SELECT * FROM vw_imagens WHERE codigo_imovel = :codigo";
        $this->query($query);
        $this->bind(':codigo', $imovel_codigo);
        $this->execute();
        return $this->resultSet();

    }

    public function uploadPrincipal($imovel_codigo)
    {
        $codigo = $imovel_codigo;

        $handle = new \upload($_FILES['arquivo'], 'pt_BR');

        $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/' . $codigo . '/';

        // Pegando imagem já do banco
        $Imovel = new Imovel_DAO();
        $result = $Imovel->get($codigo);
        $nome_img = $result['imagemPrincipal'];

        if ($nome_img == 'default.png') {
            $nome_img = $codigo . '_' . rand();
            $update = true;
        } else {
            $nome_img = explode('.', $nome_img);
            $nome_img = $nome_img[0];
            $update = false;
        }

        if ($handle->uploaded) {
            $handle->file_new_name_body = $nome_img;
            $handle->file_max_size = 1024 * 1024 * 3;
            $handle->allowed = array('image/*');
            $handle->file_new_name_ext = 'jpg';
            $handle->image_resize = true;
            $handle->image_x = 800;
            $handle->image_ratio_y = true;
            $handle->file_overwrite = true;
            $handle->process($pasta);
            if ($handle->processed) {

                $handle->file_new_name_body = $nome_img;
                $handle->file_name_body_add = '-thumb';
                $handle->file_new_name_ext = 'jpg';
                $handle->image_resize = true;
                $handle->image_x = 150;
                $handle->image_ratio_y = true;
                $handle->file_overwrite = true;
                $handle->process($pasta);

                if ($handle->processed) {

                    if ($update) {
                        $this->query('UPDATE imovel SET imagemPrincipal = :img WHERE codigo = :codigo');
                        $this->bind(':img', $nome_img . '.jpg');
                        $this->bind(':codigo', $codigo);
                        $this->execute();
                    }
                    $handle->clean();
                    return array('img' => 'imoveis/' . $codigo . '/' . $nome_img . '.jpg');
                }
            } else {
                Classes\Messages::setMsg($handle->error, 'error');
                Classes\Messages::getMsg();
            }
        }
    }

    public function deletePrincipal()
    {

        $codigo = strtoupper($_POST['codigo']);
        $img = $_POST['img'];

        if ($img == "default.png") {
            exit();
        }
        $thumb = explode(".jpg", $img);
        $thumb = $thumb[0] . "-thumb.jpg";

        // Pegando id do imovel
        $Imovel = new Imovel_DAO();
        $Imovel->get($codigo);
        $result = $Imovel->result();
        $imovel_id = $result['id'];

        chmod($_SERVER['DOCUMENT_ROOT'] . "/spi/assets/img/imoveis/$codigo/", 0777);
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/spi/assets/img/imoveis/$codigo/";

        if (file_exists($dir . $img)):
            unlink($dir . $img);
            if (file_exists($dir . $thumb)) {
                unlink($dir . $thumb);

                $query = "UPDATE imovel SET imagemPrincipal = 'default.png' WHERE id = :imovel_id";
                $this->query($query);
                $this->bind(':imovel_id', $imovel_id);
                $this->execute();
            }
        endif;
    }

    public function uploadGaleria($imovel_codigo)
    {

        $codigo = $imovel_codigo;

        // Pegando id do imóvel
        $Imovel = new Imovel_DAO();
        $Imovel->get($codigo);
        $imovel = $Imovel->result();
        $imovel_id = $imovel['id'];

        // Pasta destino
        $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/' . $codigo . '/';
        
        $tam = count($_FILES['arquivos']['name']);

        // verificando quantidade de arquivos
        if ($tam > 25):
            Classes\Messages::setMsg('O total de imagens enviadas deve ser menor que 25.', 'error');
            Classes\Messages::getMsg();
            exit();
        endif;
        
        // Colocando os arquivos num array acessível 
        $files = array();
        for ($i = 0; $i < $tam; $i++):
            $files[$i]['name'] = $_FILES['arquivos']['name'][$i];
            $files[$i]['type'] = $_FILES['arquivos']['type'][$i];
            $files[$i]['tmp_name'] = $_FILES['arquivos']['tmp_name'][$i];
            $files[$i]['error'] = $_FILES['arquivos']['error'][$i];
            $files[$i]['size'] = $_FILES['arquivos']['size'][$i];
        endfor;

        $i = 0;
        foreach ($files as $imagem):

            $nome_img = $codigo . '-' . rand() . '-galeria-';

            $handle = new \upload($imagem, 'pt_BR');
            if ($handle->uploaded):
                $handle->file_new_name_body = $nome_img;
                $handle->file_max_size = 1024 * 1024 * 3;
                $handle->allowed = array('image/*');
                $handle->file_new_name_ext = 'jpg';
                $handle->image_resize = true;
                $handle->image_x = 800;
                $handle->image_ratio_y = true;
                $handle->file_overwrite = true;
                $handle->png_compression = 1;
                $handle->process($pasta);

                if ($handle->processed) :

                    $query = "INSERT INTO imovel_imagens(imovel_id, imagem) VALUES(:imovel_id, :img)";
                    $this->query($query);
                    $this->bind(':img', $nome_img . '.jpg');
                    $this->bind(':imovel_id', $imovel_id);
                    $this->execute();
//                    $handle->clean();

                else:
                    Classes\Messages::setMsg($handle->error, 'error');
                    Classes\Messages::getMsg();
                endif;
            endif;

            $i += 1;
        endforeach;
    }

    public function deleteGaleria()
    {

        $codigo = $_POST['codigo'];
        $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/' . $codigo . '/';

        // Pegando ID do imovel
        $Imovel = new Imovel_DAO();
        $imovel = $Imovel->get($codigo);
        $imovel_id = $imovel['id'];

        // Pegando o nome das imagens do banco
        $query = "SELECT imagem FROM imovel_imagens WHERE imovel_id = :id";
        $this->query($query);
        $this->bind(':id', $imovel_id);
        $this->execute();
        $imagens = $this->resultset();

        // Deletando da pasta
        foreach ($imagens as $img):
            if (!unlink($pasta . $img['imagem'])):
                Classes\Messages::setMsg('Desculpe, não foi possível excluir algumas imagens. Contate o suporte.', 'error');
                Classes\Messages::getMsg();
                exit();
            endif;

        endforeach;

        // Deletando do banco
        $query = "DELETE FROM imovel_imagens WHERE imovel_id = :id";
        $this->query($query);
        $this->bind(':id', $imovel_id);
        $this->execute();
    }

    public function deleteImgGaleria()
    {
        $codigo = $_POST['codigo'];

        $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/' . $codigo . '/';
        chmod($pasta, 0777);

        $imagem_id = $_POST['imagem_id'];
        $img = $_POST['img'];

        // Pegando id do imovel
        $Imovel = new Imovel_DAO();
        $result = $Imovel->get($codigo);
        $imovel_id = $result['id'];

        if (unlink($pasta . $img)) {
            $query = "DELETE FROM imovel_imagens WHERE imovel_id = :imovel_id AND id = :imagem_id";
            $this->query($query);
            $this->bind(':imovel_id', $imovel_id);
            $this->bind(':imagem_id', $imagem_id);
            $this->execute();
        }
    }

}
