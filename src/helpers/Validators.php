<?php

require_once(__DIR__ . '/../config/DatabaseOperations.php');
require_once(__DIR__ . '/exceptions/ValidationException.php');

/**
 * A classe Validators fornece métodos estáticos para validação de dados comuns, como nomes, e-mails, RMs e senhas.
 */
class Validators
{
  /**
   * Construtor da classe Validators.
   */
  public function __construct()
  {
    // O construtor é explícito, mas não realiza nenhuma ação específica.
  }

  /**
   * Verifica se o nome fornecido atende a critérios de validação específicos.
   *
   * @param string $nome O nome a ser validado.
   *
   * @return bool Retorna verdadeiro se o nome for válido, false caso contrário.
   * @throws ValidationException Se o nome não for válido.
   */
  public static function isValidName($nome)
  {
    // Verifique se o nome não está vazio.
    if (empty($nome)) {
      throw new ValidationException("Nome não pode estar vazio.");
    }

    // Utilizando expressão regular (Regex) para verificar se o nome contém apenas letras e espaços.
    if (!preg_match('/^[A-Za-zÀ-ú\s]+$/', $nome)) {
      throw new ValidationException("Nome contém caracteres inválidos.");
    }

    if (strlen($nome) < 2) {
      throw new ValidationException("Nome é muito curto.");
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
   * @throws ValidationException Se o e-mail não for válido.
   */
  public static function isValidEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new ValidationException("E-mail inválido.");
    }

    $_dbConnection = new DatabaseOperations();

    // Verifique se o e-mail já existe no banco de dados usando a classe DatabaseOperations.
    if ($_dbConnection->getOneUserByEmail($email)) {
      throw new ValidationException("E-mail inválido. E-mail já está em uso.");
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
   * @throws ValidationException Se o RM não for válido ou não for único.
   */
  public static function isValidRM($rm)
  {
    // Utilizando expressão regular para verificar se o RM é um número inteiro válido.
    if (!preg_match('/^\d{5}$/', $rm)) {
      throw new ValidationException("RM inválido.");
    }

    // Crie uma instância da classe DatabaseOperations.
    $_dbConnection = new DatabaseOperations();

    // Verifique se o RM já existe no banco de dados usando a classe DatabaseOperations.
    if ($_dbConnection->getOneAlunoByRM($rm)) {
      throw new ValidationException("RM inválido. RM já está em uso.");
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
   * @throws ValidationException Se a senha não for válida.
   */
  public static function isValidPassword($senha)
  {
    // Verificando se a senha tem pelo menos 8 caracteres.
    if (strlen($senha) < 8) {
      throw new ValidationException("Senha deve ter pelo menos 8 caracteres.");
    }

    // Utilizando expressão regular (Regex) para verificar se a senha contém pelo menos um caractere em maiúsculo.
    if (!preg_match('/[A-Z]/', $senha)) {
      throw new ValidationException("Senha deve conter pelo menos uma letra maiúscula.");
    }

    // Utilizando expressão regular (Regex) para verificar se a senha contém pelo menos um caractere especial (por exemplo, !@#$%^&*).
    if (!preg_match('/[!@#$%^&*]/', $senha)) {
      throw new ValidationException("Senha deve conter pelo menos um caractere especial.");
    }

    // Se todas as validações passarem, retorna true.
    return true;
  }
}
