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
  public function __construct()
  {
    // Chama o construtor da classe pai (Connection) para estabelecer a conexão com o banco de dados.
    parent::__construct();
  }

  /**
   * Cria um novo aluno no banco de dados.
   *
   * @param string $nome O nome do aluno.
   * @param string $email O email do aluno.
   * @param string $senha A senha do aluno.
   * @param int $rm O RM do aluno.
   * @param string $curso O curso do aluno.
   * @param string $type O tipo de usuário (aluno, admin).
   * @param bool $status O status do aluno.
   *
   * @return bool True se o aluno foi cadastrado com sucesso, false caso contrário.
   */
  public function createAluno($nome, $email, $senha, $rm, $curso, $type, $status)
  {
    // Prepara a consulta SQL para inserir um novo aluno.
    $stmt = $this->_dbConnection->prepare("INSERT INTO usuarios (nome, email, senha, rm, curso, type, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $rm, PDO::PARAM_INT);
    $stmt->bindParam(5, $curso, PDO::PARAM_STR);
    $stmt->bindParam(6, $type, PDO::PARAM_STR);
    $stmt->bindParam(7, $status, PDO::PARAM_BOOL);

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
    return $stmt->execute();
  }

  /**
   * Cria um novo administrador no banco de dados.
   *
   * @param string $nome O nome do administrador.
   * @param string $email O email do administrador.
   * @param string $senha A senha do administrador.
   * @param string $type O tipo de usuário (aluno, admin).
   *
   * @return bool True se o administrador foi cadastrado com sucesso, false caso contrário.
   */
  public function createAdm($nome, $email, $senha, $type)
  {
    // Prepara a consulta SQL para inserir um novo administrador.
    $stmt = $this->_dbConnection->prepare("INSERT INTO usuarios (nome, email, senha, type) VALUES (?, ?, ?, ?)");

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $type, PDO::PARAM_STR);

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
    return $stmt->execute();
  }

  /**
   * Obtém todos os usuários do banco de dados.
   *
   * @return array|false Retorna um array associativo com os dados dos usuários se a consulta for bem-sucedida, caso contrário, retorna false.
   */
  public function getUsers()
  {
    // Prepara a consulta SQL para obter todos os usuários.
    $sql = "SELECT id, nome, email, senha, rm, curso, type, status FROM usuarios";
    $stmt = $this->_dbConnection->prepare($sql);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um usuário com base no seu nome.
   *
   * @param string $nome O nome do usuário a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do usuário se encontrado, caso contrário, retorna false.
   */
  public function getUserByNome($nome)
  {
    $sql = "SELECT id, nome, email, senha, rm, curso, type, status FROM usuarios WHERE nome = ?";
    $stmt = $this->_dbConnection->prepare($sql);

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um usuário com base no seu e-mail.
   *
   * @param string $email O E-mail a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do usuário se encontrado, caso contrário, retorna false.
   */
  public function getUserByEmail($email)
  {
    // Prepara a consulta SQL para obter um usuário por E-mail.
    $sql = "SELECT id, nome, email, senha, rm, curso, type, status FROM usuarios WHERE email = ?";
    $stmt = $this->_dbConnection->prepare($sql);

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $email, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém todos os usuários de um tipo específico do banco de dados.
   *
   * @param string $type O tipo de usuário a ser filtrado (aluno, admin).
   * @return array|false Retorna um array associativo com os dados dos usuários do tipo especificado se a consulta for bem-sucedida, caso contrário, retorna false.
   */
  public function getUserByType($type)
  {
    // Prepara a consulta SQL para obter todos os usuários do tipo especificado.
    $sql = "SELECT id, nome, email, senha, rm, curso, type, status FROM usuarios WHERE type = ?";
    $stmt = $this->_dbConnection->prepare($sql);

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $type, PDO::PARAM_STR);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna os resultados como um array associativo.
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtém um aluno com base no seu RM.
   *
   * @param int $rm O RM aluno a ser obtido.
   *
   * @return array|false Retorna um array associativo com os dados do aluno se encontrado, caso contrário, retorna false.
   */
  public function getAlunoByRM($rm)
  {
    // Prepara a consulta SQL para obter um usuário por RM.
    $sql = "SELECT id, nome, email, senha, rm, curso, type, status FROM usuarios WHERE rm = ?";
    $stmt = $this->_dbConnection->prepare($sql);

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $rm, PDO::PARAM_INT);

    // Executa a consulta SQL.
    $stmt->execute();

    // Retorna o resultado como um array associativo.
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Atualiza o nome, e-mail, curso e senha de um aluno no banco de dados com base no seu RM.
   *
   * @param string $nome O novo nome do aluno.
   * @param string $email O novo e-mail do aluno.
   * @param string $senha A nova senha do aluno.
   * @param string $curso O novo curso do aluno.
   * @param int $rm O RM do aluno a ser atualizado.
   *
   * @return bool Retorna true se a atualização for bem-sucedida, caso contrário, retorna false.
   */
  public function updateAluno($nome, $email, $senha, $curso, $rm)
  {
    // Prepara a consulta SQL para atualizar nome, email e curso de um usuário.
    $stmt = $this->_dbConnection->prepare("UPDATE usuarios SET nome=?, email=?, curso=?, status=? WHERE rm=?");

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $curso, PDO::PARAM_STR);
    $stmt->bindParam(5, $status, PDO::PARAM_STR);
    $stmt->bindParam(6, $rm, PDO::PARAM_INT);

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
    return $stmt->execute();
  }

  /**
   * Atualiza o nome, e-mail e senha de um administrador no banco de dados.
   *
   * @param string $nome O novo nome do administrador.
   * @param string $email O novo e-mail do administrador.
   * @param string $senha A nova senha do administrador.
   *
   * @return bool Retorna true se a atualização for bem-sucedida, caso contrário, retorna false.
   */
  public function updateAdm($nome, $email, $senha)
  {
    // Prepara a consulta SQL para atualizar nome, e-mail e senha de um usuário.
    $stmt = $this->_dbConnection->prepare("UPDATE usuarios SET nome=?, email=?, senha=? WHERE email=?");

    // Vincula os parâmetros para PDO.
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->bindParam(4, $email, PDO::PARAM_STR);

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
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

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
    return $stmt->execute();
  }

  /**
   * Exclui um administrador do banco de dados com base no seu e-mail.
   * 
   * @param string $email O e-mail do administrador a ser excluído.
   *
   * @return bool Retorna true se o administrador foi excluído com sucesso, false caso contrário.
   */
  public function deleteAdm($email)
  {
    // Prepara a consulta SQL para deletar um usuário.
    $stmt = $this->_dbConnection->prepare("DELETE FROM usuarios WHERE email = ?");

    // Vincula o parâmetro para PDO.
    $stmt->bindParam(1, $email, PDO::PARAM_INT);

    // Executa a consulta SQL e retorna true se for bem-sucedida, caso contrário, retorna false.
    return $stmt->execute();
  }
}
