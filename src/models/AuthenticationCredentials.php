<?php

/**
 * Classe que representa as credenciais de autenticação de um usuário.
 */
class AuthenticationCredentials
{
  /**
   * Email do usuário.
   *
   * @var string
   */
  private $_email;

  /**
   * Senha do usuário.
   *
   * @var string
   */
  private $_password;

  /**
   * Construtor da classe.
   *
   * @param string $email O e-mail do usuário.
   * @param string $password A senha do usuário.
   */
  public function __construct($email, $password)
  {
    $this->_email = $email;
    $this->_password = $password;
  }

  /**
   * Obtém o email do usuário.
   *
   * @return string O email do usuário.
   */
  public function getEmail()
  {
    return $this->_email;
  }

  /**
   * Define o email do usuário.
   *
   * @param string $email O novo e-mail do usuário.
   */
  public function setEmail($email)
  {
    $this->_email = $email;
  }

  /**
   * Obtém a senha do usuário.
   *
   * @return string A senha do usuário.
   */
  public function getPassword()
  {
    return $this->_password;
  }

  /**
   * Define a senha do usuário.
   *
   * @param string $password A nova senha do usuário.
   */
  public function setPassword($password)
  {
    $this->_password = $password;
  }
}
