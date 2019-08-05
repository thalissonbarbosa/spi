<?php

namespace App\Controllers;

use App\Models as Models;
use App\Models\Clientes as Clientes_DAO;
use Lib\Base as Base;

/**
 * Description of clientes
 *
 * @author Thalisson
 */
class Clientes extends Base\Controller
{
    public function Index()
    {
        $viewmodel = new Models\Clientes();
        return $this->returnView($viewmodel, true);
    }
    
    public function Proprietarios()
    {
        return $this->Index();
    }
    public function Locatarios()
    {
        return $this->Index();
    }
    public function Fiadores()
    {
        return $this->Index();
    }
    
    // Functions
    
    // Proprietarios
    
    public function insertProprietario()
    {
        $function = new Clientes_DAO\Proprietarios_DAO();
        return $function->insert();
    }
    public function updateProprietario()
    {
        $function = new Clientes_DAO\Proprietarios_DAO();
        return $function->update();
    }
    public function deleteProprietario()
    {
        $function = new Clientes_DAO\Proprietarios_DAO();
        return $function->delete();
    }
    public function searchProprietario()
    {
        $function = new Clientes_DAO\Proprietarios_DAO();
        return $function->search();
    }
    public function searchGetProprietario()
    {
        $function = new Clientes_DAO\Proprietarios_DAO();
        return $function->searchGet();
    }
    
    // Locatarios
    
    public function insertLocatario()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->insert();
    }
    public function updateLocatario()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->update();
    }
    public function deleteLocatario()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->delete();
    }
    public function deleteLocatarioImovel()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->deleteImovel();
    }
    public function searchLocatario()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->search();
    }
    public function searchGetLocatario()
    {
        $function = new Clientes_DAO\Locatarios_DAO();
        return $function->searchGet();
    }
    
    // Fiadores
    
    public function insertFiador()
    {
        $function = new Clientes_DAO\Fiadores_DAO();
        return $function->insert();
    }
    public function updateFiador()
    {
        $function = new Clientes_DAO\Fiadores_DAO();
        return $function->update();
    }
    public function deleteFiador()
    {
        $function = new Clientes_DAO\Fiadores_DAO();
        return $function->delete();
    }
    public function deleteFiadorAssoc()
    {
        $function = new Models\Imovel\Fiadores_DAO();
        return $function->delete();
    }
    public function searchFiador()
    {
        $function = new Clientes_DAO\Fiadores_DAO();
        return $function->search();
    }
    public function searchGetFiador()
    {
        $function = new Clientes_DAO\Fiadores_DAO();
        return $function->searchGet();
    }
    
}
