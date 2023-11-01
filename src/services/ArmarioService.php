<?php

require_once(__DIR__ . '/../models/Armario.php');
require_once(__DIR__ . '/../interfaces/DatabaseOperationsProvider.php');
require_once(__DIR__ . '/../config/DatabaseOperations.php');

class ArmarioService implements DatabaseOperationsProvider
{
  /**
   * @var DatabaseOperations $_dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  private $_dbConnection;

  /**
   * Construtor da classe ArmarioService.
   *
   * @param DatabaseOperations $dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  public function __construct(DatabaseOperations $dbConnection)
  {
    $this->_dbConnection = $dbConnection;
  }

  public function create(Armario $armario)
  {
  }
}
