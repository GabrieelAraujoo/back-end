<?php

require_once(__DIR__ . '/../models/Aluno.php');
require_once(__DIR__ . '/../helpers/Validators.php');
require_once(__DIR__ . '/../config/DatabaseOperations.php');

/**
 * A classe AlunoService fornece métodos para realizar operações relacionadas aos alunos.
 */
class AlunoService
{
  /**
   * @var DatabaseOperations $_dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  private $_dbConnection;

  /**
   * Construtor da classe AlunoService.
   *
   * @param DatabaseOperations $dbConnection Uma instância de DatabaseOperations para interagir com o banco de dados.
   */
  public function __construct(DatabaseOperations $dbConnection)
  {
    $this->_dbConnection = $dbConnection;
  }

  /**
   * Cadastra um aluno no sistema.
   *
   * Este método valida os dados do aluno e, se forem válidos, realiza o cadastro no banco de dados.
   *
   * @param Aluno $aluno Um objeto Aluno contendo os dados do aluno a ser cadastrado.
   *
   * @return bool Retorna true se o cadastro for bem-sucedido, caso contrário, retorna false.
   */
  public function cadastrarAlunoService(Aluno $aluno)
  {
    if (
      Validators::isValidName($aluno->getNome()) &&
      Validators::isValidEmail($aluno->getEmail()) &&
      Validators::isValidPassword($aluno->getSenha()) &&
      Validators::isValidRM($aluno->getRM())
    ) {
      return $this->_dbConnection->createAluno(
        $aluno->getNome(),
        $aluno->getEmail(),
        password_hash($aluno->getSenha(), PASSWORD_DEFAULT),
        $aluno->getRM(),
        $aluno->getCurso(),
        $aluno->getType()
      );
    }
    return false;
  }
}
