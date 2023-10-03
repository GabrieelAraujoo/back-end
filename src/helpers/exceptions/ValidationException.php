<?php

/**
 * Classe de exceção personalizada para erros de validação.
 */
class ValidationException extends Exception
{
  /**
   * Construtor da exceção de validação.
   *
   * @param string $message A mensagem de erro.
   * @param int $code O código de erro (opcional).
   * @param Exception $previous A exceção anterior (opcional).
   */
  public function __construct(
    $message,
    $code = 0,
    Exception $previous = null
  ) {
    parent::__construct($message, $code, $previous);
  }
}
