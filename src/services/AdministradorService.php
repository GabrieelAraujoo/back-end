<?php

require_once(__DIR__ . '/../models/Administrador.php');
require_once(__DIR__ . '/../interfaces/DatabaseOperationsProvider.php');
require_once(__DIR__ . '/../helpers/Validators.php');
require_once(__DIR__ . '/../config/DatabaseOperations.php');

/**
 * A classe AdministradorService fornece métodos para realizar operações relacionadas aos administradores.
 */
class AdministradorService implements DatabaseOperationsProvider
{
  /**
   * @var DatabaseOperations $_dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  private $_dbConnection;

  /**
   * Construtor da classe AdministradorService.
   *
   * @param DatabaseOperations $dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  public function __construct(DatabaseOperations $dbConnection)
  {
    $this->_dbConnection = $dbConnection;
  }

  /**
   * Cadastra um administrador no sistema.
   *
   * Este método valida os dados do administrador e, se forem válidos, realiza o cadastro no banco de dados.
   *
   * @param Administrador $adm Um objeto Administrador contendo os dados do administrador a ser cadastrado.
   *
   * @return bool Retorna true se o cadastro for bem-sucedido, caso contrário, retorna false.
   */
  public function cadastrarAdministrador(Administrador $adm)
  {
    if (
      Validators::isValidName($adm->getNome()) &&
      Validators::isValidEmail($adm->getEmail()) &&
      Validators::isValidPassword($adm->getSenha())
    ) {
      return $this->_dbConnection->createAdm(
        $adm->getNome(),
        $adm->getEmail(),
        password_hash($adm->getSenha(), PASSWORD_DEFAULT),
        $adm->getType()
      );
    }
    return false;
  }
}
