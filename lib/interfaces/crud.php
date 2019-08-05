<?php

namespace Lib\Interfaces;

/**
 * Description of CRUD
 *
 * @author Thalisson
 */
interface CRUD
{
    
    public function insert();
    
    public function update();
    
    public function delete();
    
    public function get($id);
    
    public function getList();
    
    public function search();
  
}
