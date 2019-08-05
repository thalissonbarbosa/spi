<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

/**
 * Description of imovel
 *
 * @author Thalisson
 */
class Imovel extends Base\Controller
{
    // ---------- PAGINAS

    public function index()
    {
        $viewmodel = new Models\Imovel();
        $this->returnView($viewmodel->Index(), true);
    }

    public function detalhes()
    {
        $this->index();
    }

    public function cadastrar()
    {
        $this->index();
    }

    public function editar()
    {
        $this->index();
    }

    public function lista()
    {
        $this->index();
    }
    
    public function sucesso()
    {
        $this->index();
    }

    // --------- IMOVEL _DAO
    
    public function insertImovel()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->insert();
    }
    
    public function updateImovel()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->update();
    }
    
    public function disableImovel()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->delete();
    }
    
    public function enableImovel()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->enable();
    }

    public function searchImovelGet()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->searchGet();
    }

    public function searchImovel()
    {
        $function = new Models\Imovel\Imovel_DAO();
        return $function->search();
    }
    
    
    // ----- CLIENTES
    public function deleteLocatario()
    {
        $function = new Models\Imovel\Locatarios_DAO();
        return $function->delete();
    }
    public function deleteProprietario()
    {
        $function = new Models\Imovel\Proprietarios_DAO();
        return $function->delete();
    }
    
    // --------- GALERIA
    
    public function deleteImgPrincipal()
    {
        $function = new Models\Imovel\Galeria_DAO();
        return $function->deletePrincipal();
    }
    
    public function deleteImgGaleria()
    {
        $function = new Models\Imovel\Galeria_DAO();
        return $function->deleteImgGaleria();
    }
    
    public function deleteGaleria()
    {
        $function = new Models\Imovel\Galeria_DAO();
        return $function->deleteGaleria();
    }
    
    // ---------- DETALHES
    public function addAtributo()
    {
        $function = new Models\Imovel\Atributos_DAO();
        return $function->add();
    }
    public function removeAtributo()
    {
        $function = new Models\Imovel\Atributos_DAO();
        return $function->remove();
    }
    public function updateRecurso()
    {
        $function = new Models\Imovel\Recursos_DAO();
        return $function->update();
    }
    
    // ---------- SEARCH
       
    public function searchCliente()
    {
        $function = new Models\Imovel\Clientes_DAO();
        return $function->search();
    }
}
