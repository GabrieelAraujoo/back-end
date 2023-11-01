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
   * Este método recebe um array de resposta e constrói a resposta JSON final que será enviada como saída.
   *
   * @param array $response Um array contendo a resposta JSON.
   * @return string A resposta JSON final, pronta para ser enviada.
   */
  private static function build($response)
  {
    // Define o tipo de conteúdo da resposta como JSON.
    header("Content-Type: application/json; charset=UTF-8");

    // Retorna a resposta JSON.
    return json_encode($response, JSON_UNESCAPED_UNICODE);
  }

  /**
   * Constrói uma resposta JSON de sucesso com código de resposta.
   *
   * Este método gera uma resposta JSON indicando um resultado de sucesso, juntamente com um código de resposta HTTP
   * apropriado.
   * Pode opcionalmente incluir dados adicionais na resposta, se fornecidos.
   *
   * @param string $message Uma mensagem de sucesso a ser incluída na resposta JSON.
   * @param int $statusCode O código de resposta HTTP a ser definido na resposta.
   * @param mixed|null $data Dados adicionais (opcional) a serem incluídos na resposta.
   * @return string A resposta JSON de sucesso pronta para ser enviada.
   */
  public static function success($message, $statusCode, $data = null)
  {
    $response = [
      'error' => false,
      'message' => $message
    ];

    // Define o código de resposta HTTP.
    http_response_code($statusCode);

    if ($data !== null) {
      $response['data'] = $data;
    }

    return self::build($response);
  }

  /**
   * Constrói uma resposta JSON de erro com código de resposta.
   *
   * Este método gera uma resposta JSON indicando um resultado de erro, juntamente com um código de resposta HTTP
   * apropriado.
   * A mensagem de erro é incluída na resposta.
   *
   * @param string $message Uma mensagem de erro a ser incluída na resposta JSON.
   * @param int $statusCode O código de resposta HTTP a ser definido na resposta.
   * @return string A resposta JSON de erro pronta para ser enviada.
   */
  public static function error($message, $statusCode)
  {
    $response = [
      'error' => true,
      'message' => $message
    ];

    // Define o código de resposta HTTP.
    http_response_code($statusCode);

    return self::build($response);
  }
}
