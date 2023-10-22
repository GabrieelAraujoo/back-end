<?php

require_once(__DIR__ . '/../services/AdministradorService.php');
require_once(__DIR__ . '/../services/AuthService.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Administrador.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Controlador responsável por processar solicitações relacionadas ao cadastro de administradores.
 */
class AdministradorController
{
  /**
   * @var AdministradorService $_administradorService O serviço de administradores.
   */
  private $_administradorService;

  /**
   * Construtor da classe AdministradorController.
   *
   * @param AdministradorService $administradorService Uma instância do serviço de administradores.
   */
  public function __construct(AdministradorService $administradorService)
  {
    $this->_administradorService = $administradorService;
  }

  /**
   * Processa o cadastro de um administrador com base nos dados do formulário.
   *
   * Este método cria um objeto Administrador com base nos valores do formulário no $_POST
   * e chama o serviço para cadastrar o administrador. Retorna uma resposta JSON de sucesso
   * em caso de sucesso ou uma resposta JSON de erro em caso de validação falha.
   *
   * @return string A resposta JSON que pode conter uma mensagem de sucesso ou erro.
   */
  public function create()
  {
    try {
      $adm = new Administrador(
        $_POST['name'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['type']
      );

      // Chama o serviço para cadastrar o administrador.
      $this->_administradorService->cadastrarAdministrador($adm);

      // Define o código de resposta HTTP para sucesso.
      http_response_code(200);

      // Define a resposta JSON de sucesso.
      $response = ResponseBuilder::successResponse(
        "Administrador(a) cadastrado(a) com sucesso."
      );
    } catch (ValidationException $e) {

      // Define o código de resposta HTTP para falha de validação.
      http_response_code(400);

      // Define a resposta JSON de erro de validação.
      $response = ResponseBuilder::errorResponse(
        "Erro de validação: {$e->getMessage()}"
      );
    } catch (Exception $e) {

      // Define o código de resposta HTTP para erro interno do servidor.
      http_response_code(500);

      // Define a resposta JSON de erro desconhecido.
      $response = ResponseBuilder::errorResponse(
        "Erro desconhecido: {$e->getMessage()}"
      );
    }

    // Retorna a resposta final.
    return $response;
  }

  /**
   * Processa a solicitação de login do administrador.
   *
   * Verifica se a solicitação é do tipo POST e tenta autenticar o administrador
   * com base nas credenciais fornecidas.
   *
   * @return string Retorna uma resposta JSON com o resultado da autenticação.
   */
  public function login()
  {
    // Verifica se a solicitação é do tipo POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Tenta realizar a autenticação.
      try {
        AuthService::login($_POST['email'], $_POST['senha']);

        // Define o código de resposta HTTP para sucesso.
        http_response_code(200);

        // Define a resposta JSON de sucesso.
        $response = ResponseBuilder::successResponse(
          "Autenticação bem-sucedida."
        );
      } catch (ValidationException $e) {

        // Define o código de resposta HTTP para falha de validação.
        http_response_code(401);

        // Define a resposta JSON de falha.
        $response = ResponseBuilder::errorResponse(
          "Autenticação falhou. Verifique suas credenciais."
        );
      } catch (Exception $e) {

        // Define o código de resposta HTTP para erro interno do servidor.
        http_response_code(500);

        // Define a resposta JSON de falha.
        $response = ResponseBuilder::errorResponse(
          "Erro desconhecido: {$e->getMessage()}"
        );
      }
    } else {

      // Define o código de resposta HTTP para requisição inválida.
      http_response_code(400);

      // Define a resposta JSON de falha.
      $response = ResponseBuilder::errorResponse("Requisição inválida.");
    }

    // Retorna a resposta final.
    return $response;
  }
}
