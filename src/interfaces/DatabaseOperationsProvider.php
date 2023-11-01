<?php

/**
 * Interface para fornecer operações de banco de dados a serviços.
 */
interface DatabaseOperationsProvider
{
  /**
   * Construtor da classe.
   *
   * @param DatabaseOperations $dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  public function __construct(DatabaseOperations $dbConnection);
}
