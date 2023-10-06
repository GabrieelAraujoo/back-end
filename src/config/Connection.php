<?php

/**
 * Classe que representa a conexão com o banco de dados.
 * Contém configurações de conexão e fornece uma instância PDO para interagir com o banco de dados.
 */
class Connection
{
  /**
   * @var string $_host O host do banco de dados.
   */
  private $_host = "localhost";

  /**
   * @var string $_user O nome de usuário do banco de dados.
   */
  private $_user = "Arlock1";

  /**
   * @var string $_password A senha do banco de dados.
   */
  private $_password = "123456";

  /**
   * @var string $_dbName O nome do banco de dados.
   */
  private $_dbName = "dbArlock";

  /**
   * @var PDO $_dbConnection Uma instância PDO que representa a conexão com o banco de dados.
   */
  protected $_dbConnection;

  /**
   * Construtor da classe Connection.
   *
   * Este construtor cria uma conexão PDO com o banco de dados usando as configurações fornecidas.
   * Em caso de erro na conexão, ele lança exceções para lidar com diferentes tipos de erros.
   *
   * @throws Exception Lança uma exceção em caso de erro na conexão.
   */
  function __construct()
  {
    // Tenta criar uma conexão PDO no construtor.
    try {
      $this->_dbConnection = new PDO(
        "mysql:host=$this->_host;dbname=$this->_dbName",
        $this->_user,
        $this->_password
      );
      $this->_dbConnection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
      );
    } catch (PDOException $e) {

      // Em caso de erro na conexão, lança uma exceção.
      throw new Exception(
        "Erro ao conectar com o banco de dados: {$e->getMessage()}"
      );
    } catch (Exception $e) {

      // Em caso de erro desconhecido, lança uma exceção.
      throw new Exception("Erro desconhecido: {$e->getMessage()}");
    }
  }
}
