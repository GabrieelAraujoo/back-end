<?php

/**
 * Representa a estrutura de dados de um administrador.
 * Contém propriedades correspondentes às colunas da tabela do banco de dados.
 * Os objetos desta classe são frequentemente usados para mapear registros de banco de dados para objetos na linguagem de programação.
 */
class Administrador
{
  /**
   * @var int $_id O ID único do administrador.
   */
  private $_id;

  /**
   * @var string $_nome O nome do administrador.
   */
  private $_nome;

  /**
   * @var string $_email O endereço de e-mail do administrador.
   */
  private $_email;

  /**
   * @var string $_senha A senha do administrador.
   */
  private $_senha;

  /**
   * @var string $_type O tipo de usuário.
   */
  private $_type;

  /**
   * @var bool $_status O status do aluno.
   */
  private $_status;

  /**
   * Construtor da classe Administrador.
   *
   * @param string $nome  O nome do administrador.
   * @param string $email O endereço de e-mail do administrador.
   * @param string $senha A senha do administrador.
   */
  public function __construct($nome, $email, $senha, $type)
  {
    $this->_nome = $nome;
    $this->_email = $email;
    $this->_senha = $senha;
    $this->_type = $type;
  }

  /**
   * Obtém o ID do administrador.
   *
   * @return int O ID do administrador.
   */
  public function getId()
  {
    return $this->_id;
  }

  /**
   * Obtém o nome do administrador.
   *
   * @return string O nome do administrador.
   */
  public function getNome()
  {
    return $this->_nome;
  }

  /**
   * Obtém o endereço de e-mail do administrador.
   *
   * @return string O endereço de e-mail do administrador.
   */
  public function getEmail()
  {
    return $this->_email;
  }

  /**
   * Obtém a senha do administrador.
   *
   * @return string A senha do administrador.
   */
  public function getSenha()
  {
    return $this->_senha;
  }

  /**
   * Obtém o tipo de usuário (usuário, admin).
   *
   * @return string O tipo de usuário do administrador.
   */
  public function getType()
  {
    return $this->_type;
  }

  /**
   * Obtém o status do administrador.
   *
   * @return bool O status do administrador.
   */
  public function getStatus()
  {
    return $this->_status;
  }

  /**
   * Define o nome do administrador.
   *
   * @param string $nome O novo nome do administrador.
   */
  public function setNome($nome)
  {
    $this->_nome = $nome;
  }

  /**
   * Define o endereço de e-mail do administrador.
   *
   * @param string $email O novo endereço de e-mail do administrador.
   */
  public function setEmail($email)
  {
    $this->_email = $email;
  }

  /**
   * Define a senha do administrador.
   *
   * @param string $senha A nova senha do administrador.
   */
  public function setSenha($senha)
  {
    $this->_senha = $senha;
  }

  /**
   * Define o tipo de usuário (aluno, admin).
   *
   * @param string $type O tipo de usuário a ser definido.
   */
  public function setType($type)
  {
    $this->_type = $type;
  }

  /**
   * Define o status do administrador.
   *
   * @param bool $status O novo status a ser definido.
   */
  public function setStatus($status)
  {
    $this->_status = $status;
  }
}
