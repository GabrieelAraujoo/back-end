<?php

require_once(__DIR__ . '/../config/DatabaseOperations.php');

/**
 * A classe Validators fornece métodos estáticos para validação de dados comuns, como nomes, e-mails, RMs e senhas.
 */
class Validators
{
  /**
   * Verifica se o nome fornecido atende a critérios de validação específicos.
   *
   * @param string $nome O nome a ser validado.
   *
   * @return bool Retorna verdadeiro se o nome for válido, false caso contrário.
   */
  public static function isValidName($nome)
  {
    // Verifique se o nome não está vazio.
    if (empty($nome)) {
      throw new Exception("Nome não pode estar vazio.");
    }

    // Utilizando expressão regular (Regex) para verificar se o nome contém apenas letras e espaços.
    if (!preg_match('/^[A-Za-zÀ-ú\s]+$/', $nome)) {
      throw new Exception("Nome contém caracteres inválidos.");
    }

    // Verificando se o nome é muito curto.
    $minLength = 2;
    if (strlen($nome) < $minLength) {
      throw new Exception("Nome é muito curto.");
    }

    // Se todas as validações passarem, retorna true.
    return true;
  }

  /**
   * Verifica se o e-mail fornecido possui um formato válido.
   *
   * @param string $email O e-mail a ser validado.
   *
   * @return bool Retorna verdadeiro se o e-mail for válido, false caso contrário.
   */
  public static function isValidEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception("E-mail inválido.");
    }

    // Crie uma instância da classe DatabaseOperations.
    $databaseOperations = new DatabaseOperations();

    // Verifique se o e-mail já existe no banco de dados usando a classe DatabaseOperations.
    if ($databaseOperations->getUserByEmail($email)) {
      throw new Exception("E-mail inválido. E-mail já está em uso.");
    }

    // Se todas as validações passarem, retorna true.
    return true;
  }

  /**
   * Verifica se o RM fornecido é válido e único no banco de dados.
   *
   * @param int $rm O RM a ser validado.
   *
   * @return bool Retorna verdadeiro se o RM for válido e único, false caso contrário.
   */
  public static function isValidRM($rm)
  {
    // Utilizando expressão regular para verificar se o RM é um número inteiro válido.
    if (!preg_match('/^\d{5}$/', $rm)) {
      throw new Exception("RM inválido.");
    }

    // Crie uma instância da classe DatabaseOperations.
    $databaseOperations = new DatabaseOperations();

    // Verifique se o RM já existe no banco de dados usando a classe DatabaseOperations.
    if ($databaseOperations->getAlunoByRM($rm)) {
      throw new Exception("RM inválido. RM já está em uso.");
    }

    // Se todas as validações passarem, retorna true.
    return true;
  }

  /**
   * Verifica se a senha fornecida atende a critérios de validação específicos.
   *
   * @param string $senha A senha a ser validada.
   *
   * @return bool Retorna verdadeiro se a senha for válida, false caso contrário.
   */
  public static function isValidPassword($senha)
  {
    // Verificando se a senha tem pelo menos 8 caracteres.
    if (strlen($senha) < 8) {
      throw new Exception("Senha deve ter pelo menos 8 caracteres.");
    }

    // Utilizando expressão regular (Regex) para verificar se a senha contém pelo menos um caractere em maiúsculo.
    if (!preg_match('/[A-Z]/', $senha)) {
      throw new Exception("Senha deve conter pelo menos uma letra maiúscula.");
    }

    // Utilizando expressão regular (Regex) para verificar se a senha contém pelo menos um caractere especial (por exemplo, !@#$%^&*).
    if (!preg_match('/[!@#$%^&*]/', $senha)) {
      throw new Exception("Senha deve conter pelo menos um caractere especial.");
    }

    // Se todas as validações passarem, retorna true.
    return true;
  }
}
