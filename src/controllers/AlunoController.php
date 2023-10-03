<?php

require_once(__DIR__ . '/../services/AlunoService.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Aluno.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');
require_once(__DIR__ . '/../helpers/LoginControllerUtil.php');

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
   * Processa o cadastro de um aluno com base nos dados do formulário.
   *
   * Este método cria um objeto Aluno com base nos valores do formulário no $_POST
   * e chama o serviço para cadastrar o aluno. Retorna uma resposta JSON de sucesso
   * em caso de sucesso ou uma resposta JSON de erro em caso de validação falha.
   *
   * @return string A resposta JSON que pode conter uma mensagem de sucesso ou erro.
   */
  public function processarCadastroAluno()
  {
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

      // Retorna uma resposta JSON de sucesso.
      return ResponseBuilder::successResponse(
        "Aluno(a) cadastrado(a) com sucesso."
      );
    } catch (ValidationException $e) {

      return ResponseBuilder::errorResponse(
        "Erro de validação: {$e->getMessage()}"
      );
    } catch (Exception $e) {

      return ResponseBuilder::errorResponse(
        "Erro desconhecido: {$e->getMessage()}"
      );
    }
  }

  /**
   * Processa a tentativa de login de um aluno com base nos dados fornecidos.
   *
   * Verifica se a requisição é do tipo POST, recebe o e-mail e senha
   * do formulário e tenta autenticar o aluno usando o serviço de autenticação.
   * Em caso de sucesso, retorna uma resposta JSON de sucesso com código HTTP 200.
   * Em caso de falha de validação, retorna uma resposta JSON de erro com código HTTP 401
   * e uma mensagem de erro descritiva. Em caso de erro desconhecido, retorna uma resposta
   * JSON de erro com código HTTP 500.
   *
   * @return string A resposta JSON que pode conter uma mensagem de sucesso ou erro.
   */
  public function processarLoginAluno()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      return LoginControllerUtil::processarLogin($email, $senha);
    }
    http_response_code(400);
    return ResponseBuilder::errorResponse("Requisição inválida.");
  }
}
