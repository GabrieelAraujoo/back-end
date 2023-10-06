<?php

require_once(__DIR__ . '/../config/DatabaseOperations.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Classe AuthService para autenticação de usuários.
 */
class AuthService
{
  /**
   * Construtor da classe AuthService.
   */
  public function __construct()
  {
    // O construtor é explícito, mas não realiza nenhuma ação específica.
  }

  /**
   * Realiza a autenticação do usuário com base no e-mail e senha fornecidos.
   *
   * @param string $email O e-mail do usuário.
   * @param string $senha A senha do usuário.
   *
   * @return bool Retorna true se o login for bem-sucedido para um aluno ou administrador, caso contrário, retorna false.
   * @throws ValidationException Lança uma exceção se o e-mail fornecido for inválido.
   */
  public static function login($email, $senha)
  {
    // Verifique se o e-mail é válido.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new ValidationException("E-mail inválido.");
    }

    // Cria uma instância da classe DatabaseOperations.
    $_dbConnection = new DatabaseOperations();

    // Obtém um usuário com base no e-mail.
    $user = $_dbConnection->getOneUserByEmail($email);

    // Verifica se o usuário existe e se a senha fornecida coincide com a senha armazenada no banco de dados.
    if ($user && password_verify($senha, $user['senha'])) {

      // Verifica se o tipo de usuário é 'aluno' ou 'admin'.
      if ($user['type'] === 'aluno' || $user['type'] === 'admin') {

        // Login bem-sucedido para aluno ou administrador.
        return true;
      }
    }

    // Retorna falso se o usuário não estiver autenticado.
    return false;
  }
}
