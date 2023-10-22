<?php

require_once(__DIR__ . '/../services/AlunoService.php');
require_once(__DIR__ . '/../services/AuthService.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Aluno.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Controlador responsável por processar solicitações relacionadas ao cadastro de alunos.
 */
class AlunoController
{
  /**
   * @var AlunoService $_alunoService O serviço de alunos.
   */
  private $_alunoService;

  /**
   * Construtor da classe AlunoController.
   *
   * @param AlunoService $alunoService Uma instância do serviço de alunos.
   */
  public function __construct(AlunoService $alunoService)
  {
    $this->_alunoService = $alunoService;
  }

  /**
   * Processa a solicitação de cadastro de um aluno.
   *
   * Este método recebe os dados do aluno através de uma solicitação POST, cria uma instância
   * de aluno e chama o serviço para cadastrar o aluno. Em caso de sucesso, retorna
   * uma resposta JSON indicando que o aluno foi cadastrado com sucesso. Em caso de erro de
   * validação ou erro desconhecido, retorna uma resposta JSON de erro.
   *
   * @return string Uma resposta JSON indicando o resultado do cadastro. A resposta
   * contém informações sobre o sucesso ou falha do cadastro.
   */
  public function create()
  {
    // Tenta realizar o cadastro.
    try {
      $aluno = new Aluno(
        $_POST['name'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['rm'],
        $_POST['curso'],
        $_POST['type']
      );

      // Chama o serviço para cadastrar o aluno.
      $this->_alunoService->cadastrarAluno($aluno);

      // Define o código de resposta HTTP para sucesso.
      http_response_code(200);

      // Define a resposta JSON de sucesso.
      $response = ResponseBuilder::successResponse(
        "Aluno(a) cadastrado(a) com sucesso."
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
   * Processa a solicitação de login do aluno.
   *
   * Este método verifica se a solicitação HTTP é do tipo POST e tenta autenticar o aluno
   * com base nas credenciais fornecidas. Ele retorna uma resposta JSON que indica o resultado
   * da autenticação, incluindo sucesso, falha de autenticação, falha de validação ou erro interno.
   *
   * @return string Uma resposta JSON contendo informações sobre o resultado da autenticação.
   * O formato da resposta pode incluir mensagens de sucesso ou erro, bem como códigos de status HTTP.
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
