<?php

require_once(__DIR__ . '/connection.php');

/**
 * Classe DatabaseOperations
 *
 * Esta classe lida com operações no banco de dados, estendendo a classe Connection para estabelecer a conexão.
 * Ela fornece métodos para realizar operações comuns, como inserir, atualizar, buscar e excluir dados relacionados aos usuários.
 */
class DatabaseOperations extends Connection
{
  /**
   * Construtor da classe DatabaseOperations.
   */
  public function __construct()
  {
    // Chama o construtor da classe pai (Connection) para estabelecer a conexão com o banco de dados.
    parent::__construct();
  }

  /**
   * Obtém todos os usuários do banco de dados.
   *
   * @return array|false Retorna um array associativo com os dados dos usuários se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getUsers()
  {
    // Prepara a consulta SQL para obter todos os usuários.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios"
    );

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém os usuários com base no nome.
   *
   * @param string $nome O nome dos usuários a serem obtidos.
   *
   * @return array|false Retorna um array associativo com os dados dos usuários se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getUsersByNome($nome)
  {
    // Prepara a consulta SQL para obter todos os usuários pelo nome especificado.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE nome = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém todos os usuários de um tipo específico do banco de dados.
   *
   * @param string $type O tipo de usuário a ser filtrado (aluno, admin).
   * @return array|false Retorna um array associativo com os dados dos usuários do tipo especificado se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getUsersByType($type)
  {
    // Prepara a consulta SQL para obter todos os usuários pelo tipo especificado.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE type = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $type, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém todos os usuários de um curso específico do banco de dados.
   *
   * @param string $curso O curso a ser filtrado.
   * @return array|false Retorna um array associativo com os dados dos usuários do curso especificado se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getUsersByCurso($curso)
  {
    // Prepara a consulta SQL para obter todos os usuários pelo curso especificado.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE curso = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $curso, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um usuário com base no seu ID.
   *
   * @param int $id O ID do usuário a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do usuário se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getOneUserById($id)
  {
    // Prepara a consulta SQL para obter um usuário pelo ID.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE id = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $id, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um usuário com base no seu e-mail.
   *
   * @param string $email O e-mail a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do usuário se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getOneUserByEmail($email)
  {
    // Prepara a consulta SQL para obter um usuário por E-mail.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE email = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $email, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém o hash da senha de um usuário pelo e-mail.
   *
   * @param string $email O endereço de e-mail do usuário.
   * 
   * @return array|false Retorna um array associativo com o hash da senha do usuário se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getHashedPasswordByEmail($email)
  {
    // Prepara a consulta SQL para obter o hash da senha do usuário pelo e-mail especificado.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE senha = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $email, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um aluno com base no seu RM.
   *
   * @param int $rm O RM do aluno a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do aluno se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getOneAlunoByRM($rm)
  {
    // Prepara a consulta SQL para obter um usuário por RM.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id, nome, email, senha, rm, curso, type FROM usuarios
      WHERE rm = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $rm, PDO::PARAM_INT);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém todos os armários do banco de dados.
   *
   * @return array|false Retorna um array associativo com os dados de todos os armários se a consulta for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function getArmarios()
  {
    // Prepara a consulta SQL para obter todos os armários.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id_arm, letra, numero, quantidade FROM armarios"
    );

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOneArmarioById($id)
  {
    // Prepara a consulta SQL para obter um armário pelo ID.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id_arm, letra, numero, quantidade FROM armarios
        WHERE id = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $letra, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém os armários de um determinado tipo associados a uma letra.
   *
   * Este método executa uma consulta SQL para buscar os armários de um tipo específico
   * associados a uma letra. Os resultados são retornados como um array associativo.
   *
   * @param string $letra A letra associada aos armários.
   * @return array Um array associativo contendo os resultados da consulta.
   */
  public function getArmariosByLetra($letra)
  {
    // Prepara a consulta SQL para buscar os armários pela letra.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id_arm, letra, numero, quantidade FROM armarios
      WHERE letra = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $letra, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getArmariosByNumero($numero)
  {
    // Prepara a consulta SQL para buscar os armários pelo número.
    $stmt = $this->_dbConnection->prepare(
      "SELECT id_arm, letra, numero, quantidade FROM armarios
      WHERE numero = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $numero, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Cria um novo aluno no banco de dados.
   *
   * @param string $nome O nome do aluno.
   * @param string $email O e-mail do aluno.
   * @param string $senha A senha do aluno.
   * @param int $rm O RM do aluno.
   * @param string $curso O curso do aluno.
   * @param string $type O tipo de usuário (aluno, admin).
   * @param bool $status O status do aluno.
   *
   * @return bool True se o aluno foi cadastrado com sucesso, false caso contrário.
   */
  public function createAluno($nome, $email, $senha, $rm, $curso, $type)
  {
    // Prepara a consulta SQL para inserir um novo aluno.
    $stmt = $this->_dbConnection->prepare(
      "INSERT INTO usuarios (nome, email, senha, rm, curso, type)
      VALUES (?, ?, ?, ?, ?, ?)"
    );

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $rm, PDO::PARAM_INT);
    $stmt->bindParam(5, $curso, PDO::PARAM_STR);
    $stmt->bindParam(6, $type, PDO::PARAM_STR);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  }

  /**
   * Cria um novo administrador no banco de dados.
   *
   * @param string $nome O nome do administrador.
   * @param string $email O e-mail do administrador.
   * @param string $senha A senha do administrador.
   * @param string $type O tipo de usuário (aluno, admin).
   *
   * @return bool True se o administrador foi cadastrado com sucesso, false caso contrário.
   */
  public function createAdm($nome, $email, $senha, $type)
  {
    // Prepara a consulta SQL para inserir um novo administrador.
    $stmt = $this->_dbConnection->prepare(
      "INSERT INTO usuarios (nome, email, senha, type)
      VALUES (?, ?, ?, ?)"
    );

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $type, PDO::PARAM_STR);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  }

  /*   public function createArmario($letra, $numero, $localization)
  {
    // Prepara a consulta SQL para inserir um novo administrador.
    $stmt = $this->_dbConnection->prepare("INSERT INTO");
  } */

  /**
   * Atualiza o nome, e-mail, curso e senha de um aluno no banco de dados com base no seu RM.
   *
   * @param string $nome O novo nome do aluno.
   * @param string $email O novo e-mail do aluno.
   * @param string $senha A nova senha do aluno.
   * @param string $curso O novo curso do aluno.
   * @param int $rm O RM do aluno a ser atualizado.
   *
   * @return bool Retorna true se a atualização for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function updateAluno($nome, $email, $senha, $curso, $rm)
  {
    // Prepara a consulta SQL para atualizar nome, e-mail e curso de um usuário.
    $stmt = $this->_dbConnection->prepare(
      "UPDATE usuarios SET nome = ?, email = ?, curso = ? WHERE rm = ?"
    );

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $curso, PDO::PARAM_STR);
    $stmt->bindParam(5, $rm, PDO::PARAM_INT);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  }

  /**
   * Atualiza o nome, e-mail e senha de um administrador no banco de dados.
   *
   * @param string $nome O novo nome do administrador.
   * @param string $email O novo e-mail do administrador.
   * @param string $senha A nova senha do administrador.
   *
   * @return bool Retorna true se a atualização for bem-sucedida.
   * Em caso de falha na consulta, retorna false.
   */
  public function updateAdm($nome, $email, $senha)
  {
    // Prepara a consulta SQL para atualizar nome, e-mail e senha de um usuário.
    $stmt = $this->_dbConnection->prepare(
      "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE email = ?"
    );

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $email, PDO::PARAM_STR);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  }

  /**
   * Exclui um aluno do banco de dados com base no seu RM.
   *
   * @param int $rm O RM do aluno a ser excluído.
   *
   * @return bool Retorna true se o aluno foi excluído com sucesso, false caso contrário.
   */
  public function deleteAluno($rm)
  {
    // Prepara a consulta SQL para deletar um usuário.
    $stmt = $this->_dbConnection->prepare("DELETE FROM usuarios WHERE rm = ?");

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $rm, PDO::PARAM_INT);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  }

  /**
   * Exclui um administrador do banco de dados com base no seu e-mail.
   * 
   * @param string $email O e-mail do administrador a ser excluído.
   *
   * @return bool Retorna true se o administrador foi excluído com sucesso, false caso contrário.
   */
  /*   public function deleteAdm($email)
  {
    // Prepara a consulta SQL para deletar um usuário.
    $stmt = $this->_dbConnection->prepare(
      "DELETE FROM usuarios WHERE email = ?"
    );

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $email, PDO::PARAM_INT);

    // Executa a consulta SQL e retorna true se for bem-sucedida.
    return $stmt->execute();
  } */
}
