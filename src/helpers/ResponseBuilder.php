<?php

/**
 * Classe para construir respostas JSON consistentes.
 */
class ResponseBuilder
{

  /**
   * Construtor privado para a classe ResponseBuilder para evitar instância da classe.
   */
  private function __construct()
  {
    // O construtor é explícito, mas não realiza nenhuma ação específica.
  }

  /**
   * Constrói a resposta JSON final.
   *
   * @param array $response Array contendo a resposta JSON.
   * @return string Resposta JSON final.
   */
  private static function buildResponse($response)
  {
    // Define o tipo de conteúdo da resposta como JSON.
    header("Content-Type: application/json; charset=UTF-8");

    // Retorna a resposta JSON.
    return json_encode($response, JSON_UNESCAPED_UNICODE);
  }

  /**
   * Constrói uma resposta JSON de sucesso.
   *
   * @param string $message Mensagem de sucesso.
   * @param mixed|null $data Dados adicionais (opcional).
   * @return string Resposta JSON de sucesso.
   */
  public static function successResponse($message, $data = null)
  {
    $response = array(
      'error' => false,
      'message' => $message
    );

    if ($data !== null) {
      $response['data'] = $data;
    }

    return self::buildResponse($response);
  }

  /**
   * Constrói uma resposta JSON de erro.
   *
   * @param string $message Mensagem de erro.
   * @return string Resposta JSON de erro.
   */
  public static function errorResponse($message)
  {
    $response = array(
      'error' => true,
      'message' => $message
    );

    return self::buildResponse($response);
  }
}
