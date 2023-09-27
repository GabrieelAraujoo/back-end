<?php

/**
 * Representa a estrutura de dados de um aluno.
 * Contém propriedades correspondentes às colunas da tabela do banco de dados.
 * Os objetos desta classe são frequentemente usados para mapear registros de banco de dados para objetos na linguagem de programação.
 */
class Aluno
{
  /**
   * @var int $_id O ID único do aluno.
   */
  private $_id;

  /**
   * @var string $_nome O nome do aluno.
   */
  private $_nome;

  /**
   * @var string $_email O endereço de e-mail do aluno.
   */
  private $_email;

  /**
   * @var string $_senha A senha do aluno.
   */
  private $_senha;

  /**
   * @var int $_rm O RM do aluno.
   */
  private $_rm;

  /**
   * @var string $_curso O curso do aluno.
   */
  private $_curso;

  /**
   * @var string $_type O tipo de usuário.
   */
  private $_type;

  /**
   * @var bool $_status O status do aluno.
   */
  private $_status;

  /**
   * Construtor da classe Aluno.
   *
   * @param string $nome  O nome do aluno.
   * @param string $email O endereço de e-mail do aluno.
   * @param string $senha A senha do aluno.
   * @param string $rm    O RM (Registro Acadêmico) do aluno.
   * @param string $curso O curso do aluno.
   * @param string $type  O tipo de usuário.
   */
  public function __construct($nome, $email, $senha, $rm, $curso, $type)
  {
    $this->_nome = $nome;
    $this->_email = $email;
    $this->_senha = $senha;
    $this->_rm = $rm;
    $this->_curso = $curso;
    $this->_type = $type;
  }

  /**
   * Obtém o ID do aluno.
   *
   * @return int O ID do aluno.
   */
  public function getId()
  {
    return $this->_id;
  }

  /**
   * Obtém o nome do aluno.
   *
   * @return string O nome do aluno.
   */
  public function getNome()
  {
    return $this->_nome;
  }

  /**
   * Obtém o endereço de e-mail do aluno.
   *
   * @return string O endereço de e-mail do aluno.
   */
  public function getEmail()
  {
    return $this->_email;
  }

  /**
   * Obtém a senha do aluno.
   *
   * @return string A senha do aluno.
   */
  public function getSenha()
  {
    return $this->_senha;
  }

  /**
   * Obtém o RM do aluno.
   *
   * @return string O RM do aluno.
   */
  public function getRM()
  {
    return $this->_rm;
  }

  /**
   * Obtém o curso do aluno.
   *
   * @return string O curso do aluno.
   */
  public function getCurso()
  {
    return $this->_curso;
  }

  /**
   * Obtém o tipo de usuário (aluno, admin).
   *
   * @return string O tipo de usuário.
   */
  public function getType()
  {
    return $this->_type;
  }

  /**
   * Obtém o status do aluno.
   *
   * @return bool O status do aluno.
   */
  public function getStatus()
  {
    return $this->_status;
  }

  /**
   * Define o nome do aluno.
   *
   * @param string $nome O novo nome do aluno.
   */
  public function setNome($nome)
  {
    $this->_nome = $nome;
  }

  /**
   * Define o endereço de e-mail do aluno.
   *
   * @param string $email O novo endereço de e-mail a ser definido.
   */
  public function setEmail($email)
  {
    $this->_email = $email;
  }

  /**
   * Define a senha do aluno.
   *
   * @param string $senha A nova senha a ser definida.
   */
  public function setSenha($senha)
  {
    $this->_senha = $senha;
  }

  /**
   * Define o RM do aluno.
   *
   * @param int $rm O novo RM a ser definido.
   */
  public function setRM($rm)
  {
    $this->_rm = $rm;
  }

  /**
   * Define o curso do aluno.
   *
   * @param string $curso O novo curso a ser definido.
   */
  public function setCurso($curso)
  {
    $this->_curso = $curso;
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
   * Define o status do aluno.
   *
   * @param bool $status O novo status a ser definido.
   */
  public function setStatus($status)
  {
    $this->_status = $status;
  }
}
