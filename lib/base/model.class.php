<?php

namespace Lib\Base;

use \PDO;

/**
 * Description of Model
 *
 * @author Thalisson
 */
abstract class Model
{

    protected $dbh;
    protected $stmt;
    protected $error;

    /*
     * Conecta com o banco de dados
     */

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset:UTF8';

        //Set OPTIONS
        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        );

        // Criando novo PDO
        try {

            $this->dbh = new \PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {

            $this->error = $e->getMessage();
            \Lib\Classes\Messages::setMsg("Não foi possível estabelecer a conexão com o banco de dados. Erro " . $e->getCode(), 'error');
            \Lib\Classes\Messages::getMsg();
        }
    }

    /*
     * Prepara a query
     */

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /*
     * BindValue
     * seta os parametros da query
     */

    public function bind($param, $value, $type = null)
    {

        if (is_null($type)):
            switch (true):

                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            endswitch;
        endif;

        $this->stmt->bindValue($param, $value, $type);
    }

    /*
     * Executa a query
     */

    public function execute()
    {

        try {

            return $this->stmt->execute();
        } catch (Exception $e) {

            $this->error = $e->getMessage();
            Messages::setMsg("Erro de conexão, por favor contate o <a href='suporte/'> Suporte</a>. Erro: " . $e->getCode(), 'error');
            Messages::getMsg();
        }
    }

    /*
     * Retorna o ID da query inserida
     */

    public function lastInsertId()
    {

        return $this->dbh->lastInsertId();
    }

    /*
     * Retorna o número de linhas - mysqli_num_rows
     */

    public function numRows()
    {

        return $this->stmt->rowCount();
    }

    /*
     * Retorna um resultado único
     * Uma linha
     */

    public function result()
    {

        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Retorna todos os resultados
     * Múltiplas linhas
     */

    public function resultset()
    {

        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function escape_string($str)
    {
        
    }

}
