<?php

require_once(__DIR__ . '/../config/DatabaseOperations.php');
require_once(__DIR__ . '/../models/AuthenticationCredentials.php');
require_once(__DIR__ . '/../interfaces/DatabaseOperationsProvider.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Classe AuthService para autenticação de usuários.
 */
class AuthService implements DatabaseOperationsProvider
{
  /**
   * @var DatabaseOperations $_dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  private $_dbConnection;

  /**
   * Construtor da classe AuthService.
   * 
   * @param DatabaseOperations $dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  public function __construct(DatabaseOperations $dbConnection)
  {
    $this->_dbConnection = $dbConnection;
  }

  /**
   * Autentica um usuário com base nas credenciais fornecidas.
   *
   * @param AuthenticationCredentials $credentials Um objeto AuthenticationCredentials contendo o e-mail e a senha do usuário.
   *
   * @return bool Retorna true se o login for bem-sucedido, caso contrário, retorna false.
   */
  public function login(AuthenticationCredentials $credentials)
  {
    // Obtém os dados do usuário com base no e-mail fornecido.
    $user = $this->_dbConnection->getOneUserByEmail($credentials->getEmail());

    // Obtém o hash da senha do usuário com base no e-mail fornecido.
    $hash = $this->_dbConnection->getHashedPasswordByEmail(
      $credentials->getEmail()
    );

    // Verifica se usuário existe e se a senha fornecida coincide com senha armazenada no banco de dados.
    if ($user && password_verify($credentials->getPassword(), $hash)) {

      // Login bem-sucedido para o usuário (aluno ou admin).
      return true;
    }

    // Retorna falso se o usuário não estiver autenticado.
    return false;
  }
}
