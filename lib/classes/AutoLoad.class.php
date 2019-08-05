<?php

/**
 * Carregamento automático de Classes
 *
 * @category Erik
 * @package  Core
 * @author   Erik Figueiredo <falecom@erikfigueiredo.com.br>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://blog.erikfigueiredo.com.br/
 *
 */
class AutoLoad {

    protected $ext;
    protected $prefix;
    protected $sufix;

    /**
     * Define o caminho local até a raiz do script
     *
     * @param string $path caminho completo até o script
     *
     * @return  Não retorna nada
     *
     */
    public function setPath($path) {
        set_include_path($path);
    }

    /**
     * Define a extensão do arquivo a ser exportado
     *
     * @param string $ext a extensão sem o ponto
     *
     * @return  Não retorna nada
     *
     */
    public function setExt($ext) {
        $this->ext = '.' . $ext;
    }

    /**
     * Define se havera algo a se colocar antes do nome do arquivo
     *
     * @param string $prefix o que vai antes do nome do arquivo
     *
     * @return  Não retorna nada
     *
     */
    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    /**
     * Define se havera algo a se colocar após o nome do arquivo
     *
     * @param string $sufix o que vai após o nome do arquivo
     *
     * @return  Não retorna nada
     *
     */
    public function setSufix($sufix) {
        $this->sufix = $sufix;
    }

    /**
     * Transforma a classe em caminho até o arquivo correspondente
     *
     * @param string $className caminho completo até o script
     *
     * @return  $fileName: o caminho até o arquivo da classe
     *
     */
    protected function setFilename($className) {
        $className = ltrim($className, "\\");
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, "\\")) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $className = $this->prefix.$className.$this->sufix;
            $fileName  = str_replace("\\", DS, $namespace) . DS;
        }
        $fileName .= $className . $this->ext;
        return strtolower($fileName);
    }

    /**
     * Carrega arquivos da Classes
     *
     * @param string $className a classe a se carregar
     *
     * @return  Não retorna nada
     *
     */
    public function loadClasses($className) {
        $this->sufix = '.class';
        $fileName = $this->setFilename($className);
        $fileName = get_include_path() . '' . DS . $fileName;
        
        if (is_readable($fileName)) {
            include $fileName;
        }
        $this->sufix = '';
    }

    /**
     * Carrega arquivos da Controller
     *
     * @param string $className a classe a se carregar
     *
     * @return  Não retorna nada
     *
     */
    public function loadController($className) {
        $fileName = $this->setFilename($className);
        $fileName = get_include_path() . DS . '' . $fileName;

        if (is_readable($fileName)) {
            include $fileName;
        }
    }

    /**
     * Carrega arquivos da Model
     *
     * @param string $className a classe a se carregar
     *
     * @return  Não retorna nada
     *
     */
    public function loadModel($className) {
        $fileName = $this->setFilename($className);
        $fileName = get_include_path() . DS . '' . $fileName;

        if (is_readable($fileName)) {

            include $fileName;
        }
    }


    /**
     * Carrega outros arquivos
     *
     * @param string $className a classe a se carregar
     *
     * @return  retorna um erro caso o arquivo não seja encontrado
     *
     */
    public function load($className) {
        $fileName = $this->setFilename($className);
        $fileName = get_include_path() . DS . $fileName;
        $fileName = strtolower($fileName);

        if (is_readable($fileName)) {
            include $fileName;
        } else {
            echo $fileName . ' não encontrado!
';
            echo '<pre>';
            var_dump(debug_backtrace());
            echo '</pre>';
            exit;
        }
    }

}
