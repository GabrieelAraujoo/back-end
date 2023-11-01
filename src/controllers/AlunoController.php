<?php

require_once(__DIR__ . '/../services/AlunoService.php');
require_once(__DIR__ . '/../services/AuthService.php');
require_once(__DIR__ . '/../interfaces/Controller.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Aluno.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Controlador responsável por processar solicitações relacionadas ao cadastro de alunos.
 */
class AlunoController implements Controller
{
  /**
   * @var AlunoService $_alunoService O serviço de alunos.
   */
  private $_alunoService;

  /**
   * @var AuthService $_authService O serviço de autenticação.
   */
  private $_authService;

  /**
   * Construtor da classe AlunoController.
   *
   * @param AlunoService $alunoService Uma instância do serviço de alunos.
   * @param AuthService $authService Uma instância do serviço de autenticação.
   */
  public function __construct(
    AlunoService $alunoService,
    AuthService $authService
  ) {
    $this->_alunoService = $alunoService;
    $this->_authService = $authService;
  }

  /**
   * Obtém todos os alunos cadastrados no sistema.
   *
   * Este método chama o serviço para buscar todos os alunos e retorna uma resposta JSON
   * contendo os alunos encontrados.
   *
   * @return string Uma resposta JSON contendo a lista de alunos ou uma mensagem de erro.
   */
  public function getAll()
  {
    // Tenta buscar todos os alunos.
    try {
      // $alunos = $this->_alunoService->;

      // Define a resposta JSON com a lista de alunos.
      $response = ResponseBuilder::success(
        "Lista de alunos(as) obtida com sucesso.",
        200,
        // $alunos
      );
    } catch (Exception $e) {

      // Define a resposta JSON de erro em caso de falha.
      $response = ResponseBuilder::error(
        "Erro ao buscar alunos: {$e->getMessage()}",
        500
      );
    }

    // Retorna a resposta final.
    return $response;
  }

  /**
   * Método para criar um novo aluno a partir dos dados fornecidos no corpo da solicitação.
   *
   * @return string Resposta JSON com o resultado da criação do aluno.
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
      $this->_alunoService->create($aluno);

      // Define a resposta JSON de sucesso.
      $response = ResponseBuilder::success(
        "Aluno(a) cadastrado(a) com sucesso.",
        200
      );
    } catch (ValidationException $e) {

      // Define a resposta JSON de erro de validação.
      $response = ResponseBuilder::error(
        "Erro de validação: {$e->getMessage()}",
        400
      );
    } catch (Exception $e) {

      // Define a resposta JSON de erro desconhecido.
      $response = ResponseBuilder::error(
        "Erro desconhecido: {$e->getMessage()}",
        500
      );
    }

    // Retorna a resposta final.
    return $response;
  }

  public function update()
  {
  }
  public function delete()
  {
  }

  /**
   * Método para autenticar um aluno com base nas credenciais fornecidas no corpo da solicitação.
   *
   * @return string Resposta JSON com o resultado da autenticação do aluno.
   */
  public function login()
  {
    // Tenta realizar a autenticação.
    try {
      $userCredentials = new AuthenticationCredentials(
        $_POST["email"],
        $_POST["password"]
      );

      // Chama o serviço para autenticar o aluno.
      $this->_authService->login($userCredentials);

      // Define a resposta JSON de sucesso.
      $response = ResponseBuilder::success(
        "Autenticação bem-sucedida.",
        200
      );
    } catch (ValidationException $e) {

      // Define a resposta JSON de falha.
      $response = ResponseBuilder::error(
        "Autenticação falhou. Verifique suas credenciais.",
        401
      );
    } catch (Exception $e) {

      // Define a resposta JSON de falha.
      $response = ResponseBuilder::error(
        "Erro desconhecido: {$e->getMessage()}",
        500
      );
    }

    // Retorna a resposta final.
    return $response;
  }
}
