<?php

require_once(__DIR__ . '/../services/AuthService.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');

/**
 * Classe utilitária para processar a tentativa de login de um usuário.
 */
class LoginControllerUtil
{
  /**
   * Construtor da classe LoginControllerUtil.
   *
   */
  public function __construct()
  {
    // O construtor é explícito, mas não realiza nenhuma ação específica.
  }

  /**
   * Processa a tentativa de login de um usuário.
   *
   * @param string $email O e-mail do usuário.
   * @param string $senha A senha do usuário.
   *
   * @return string A resposta JSON que pode conter uma mensagem de sucesso ou erro.
   */
  public static function processarLogin($email, $senha)
  {
    try {
      AuthService::loginUser($email, $senha);
      http_response_code(200);
      return ResponseBuilder::successResponse(
        "Autenticação bem-sucedida."
      );
    } catch (ValidationException $e) {
      http_response_code(401);
      return ResponseBuilder::errorResponse(
        "Autenticação falhou. Verifique suas credenciais."
      );
    } catch (Exception $e) {
      http_response_code(500);
      return ResponseBuilder::errorResponse(
        "Erro desconhecido: {$e->getMessage()}"
      );
    }
  }
}
