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
   * Este método recebe os dados do aluno através do método POST, cria uma instância
   * de aluno e chama o serviço para cadastrar o aluno. Em caso de sucesso, retorna
   * uma resposta JSON de sucesso. Em caso de erro de validação ou erro desconhecido,
   * retorna uma resposta JSON de erro.
   *
   * @return string Retorna uma resposta JSON indicando o resultado do cadastro.
   */
  public function processarCadastroAluno()
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
      $this->_alunoService->cadastrarAlunoService($aluno);

      // Define o código de resposta HTTP para sucesso.
      http_response_code(200);

      // Retorna uma resposta JSON de sucesso.
      return ResponseBuilder::successResponse(
        "Aluno(a) cadastrado(a) com sucesso."
      );
    } catch (ValidationException $e) {

      // Define o código de resposta HTTP para falha de validação.
      http_response_code(400);

      // Retorna uma resposta JSON de erro de validação.
      return ResponseBuilder::errorResponse(
        "Erro de validação: {$e->getMessage()}"
      );
    } catch (Exception $e) {

      // Define o código de resposta HTTP para erro interno do servidor.
      http_response_code(500);

      // Retorna uma resposta JSON de erro desconhecido.
      return ResponseBuilder::errorResponse(
        "Erro desconhecido: {$e->getMessage()}"
      );
    }
  }

  /**
   * Processa a solicitação de login do aluno.
   *
   * Verifica se a solicitação é do tipo POST e tenta autenticar o aluno
   * com base nas credenciais fornecidas.
   *
   * @return string Retorna uma resposta JSON com o resultado da autenticação.
   */
  public function processarLoginAluno()
  {
    // Verifica se a solicitação é do tipo POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Tenta realizar a autenticação.
      try {
        if (AuthService::login($_POST['email'], $_POST['senha'])) {

          // Define o código de resposta HTTP para sucesso.
          http_response_code(200);

          // Retorna uma resposta JSON de sucesso.
          return ResponseBuilder::successResponse(
            "Autenticação bem-sucedida."
          );
        } else {

          // Define o código de resposta HTTP para falha de autenticação.
          http_response_code(401);

          // Retorna uma resposta JSON de falha.
          return ResponseBuilder::errorResponse(
            "Autenticação falhou. Verifique suas credenciais."
          );
        }
      } catch (ValidationException $e) {

        // Define o código de resposta HTTP para falha de validação.
        http_response_code(401);

        // Retorna uma resposta JSON de falha.
        return ResponseBuilder::errorResponse(
          "Autenticação falhou. Verifique suas credenciais."
        );
      } catch (Exception $e) {

        // Define o código de resposta HTTP para erro interno do servidor.
        http_response_code(500);

        // Retorna uma resposta JSON de falha.
        return ResponseBuilder::errorResponse(
          "Erro desconhecido: {$e->getMessage()}"
        );
      }
    }

    // Define o código de resposta HTTP para requisição inválida.
    http_response_code(400);

    // Retorna uma resposta JSON de falha.
    return ResponseBuilder::errorResponse("Requisição inválida.");
  }
}
