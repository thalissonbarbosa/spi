<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models\Config as Config;

/**
 * Description of configuracoes
 *
 * @author Thalisson
 */
class Configuracoes extends Base\Controller
{

    public function Index()
    {
        $viewmodel = new \App\Models\Configuracoes();
        $this->returnView($viewmodel->Index(), true);
    }
    
    public function Atributos()
    {
        return $this->Index();
    }
    public function Categorias()
    {
        return $this->Index();
    }
    public function Corretores()
    {
        return $this->Index();
    }
    public function Prestadores()
    {
        return $this->Index();
    }
    public function Recursos()
    {
        return $this->Index();
    }
    public function Servicos()
    {
        return $this->Index();
    }
    public function Status()
    {
        return $this->Index();
    }
    public function Tipos()
    {
        return $this->Index();
    }
    public function Cadastrar_Usuario()
    {
        return $this->Index();
    }
    public function Usuarios()
    {
        return $this->Index();
    }
    
    // ---- FUNCTIONS ----
    
    // Atributos
    public function insertAtributo()
    {
        $function = new Config\Atributos_DAO();
        return $function->insert();
    }
     public function updateAtributo()
    {
        $function = new Config\Atributos_DAO();
        return $function->update();
    }
    public function deleteAtributo()
    {
        $function = new Config\Atributos_DAO();
        return $function->delete();
    }
    
    // Categorias
    public function insertCategoria()
    {
        $function = new Config\Categorias_DAO();
        return $function->insert();
    }
     public function updateCategoria()
    {
        $function = new Config\Categorias_DAO();
        return $function->update();
    }
    public function deleteCategoria()
    {
        $function = new Config\Categorias_DAO();
        return $function->delete();
    }
    
    // Corretores
    public function insertCorretor()
    {
        $function = new Config\Corretores_DAO();
        return $function->insert();
    }
     public function updateCorretor()
    {
        $function = new Config\Corretores_DAO();
        return $function->update();
    }
    public function deleteCorretor()
    {
        $function = new Config\Corretores_DAO();
        return $function->delete();
    }
    
    // Prestadores
    public function insertPrestador()
    {
        $function = new Config\Prestadores_DAO();
        return $function->insert();
    }
     public function updatePrestador()
    {
        $function = new Config\Prestadores_DAO();
        return $function->update();
    }
    public function deletePrestador()
    {
        $function = new Config\Prestadores_DAO();
        return $function->delete();
    }
    
    // Recursos
    public function insertRecurso()
    {
        $function = new Config\Recursos_DAO();
        return $function->insert();
    }
     public function updateRecurso()
    {
        $function = new Config\Recursos_DAO();
        return $function->update();
    }
    public function deleteRecurso()
    {
        $function = new Config\Recursos_DAO();
        return $function->delete();
    }
    // Recursos
    public function insertServico()
    {
        $function = new Config\Servicos_DAO();
        return $function->insert();
    }
     public function updateServico()
    {
        $function = new Config\Servicos_DAO();
        return $function->update();
    }
    public function deleteServico()
    {
        $function = new Config\Servicos_DAO();
        return $function->delete();
    }
    
    // Tipos
    public function insertTipo()
    {
        $function = new Config\Tipos_DAO();
        return $function->insert();
    }
     public function updateTipo()
    {
        $function = new Config\Tipos_DAO();
        return $function->update();
    }
    public function deleteTipo()
    {
        $function = new Config\Tipos_DAO();
        return $function->delete();
    }
    
    // Status
    public function insertStatus()
    {
        $function = new Config\Status_DAO();
        return $function->insert();
    }
     public function updateStatus()
    {
        $function = new Config\Status_DAO();
        return $function->update();
    }
    public function deleteStatus()
    {
        $function = new Config\Status_DAO();
        return $function->delete();
    }
    
    // Usuarios
    public function insertUsuario()
    {
        $function = new Config\Usuarios_DAO();
        return $function->insert();
    }
    public function updateUsuario()
    {
        $function = new Config\Usuarios_DAO();
        return $function->update();
    }
    public function deleteUsuario()
    {
        $function = new Config\Usuarios_DAO();
        return $function->delete();
    }
}
