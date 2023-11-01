<?php

require_once(__DIR__ . '/../services/AdministradorService.php');
require_once(__DIR__ . '/../services/AuthService.php');
require_once(__DIR__ . '/../interfaces/Controller.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Administrador.php');
require_once(__DIR__ . '/../helpers/exceptions/ValidationException.php');

/**
 * Controlador responsável por processar solicitações relacionadas ao cadastro de administradores.
 */
class AdministradorController implements Controller
{
  /**
   * @var AdministradorService $_admService O serviço de administradores.
   */
  private $_admService;

  /**
   * @var AuthService $_authService O serviço de autenticação.
   */
  private $_authService;

  /**
   * Construtor da classe AdministradorController.
   *
   * @param AdministradorService $admService Uma instância do serviço de administradores.
   * @param AuthService $authService Uma instância do serviço de autenticação.
   */
  public function __construct(
    AdministradorService $admService,
    AuthService $authService
  ) {
    $this->_admService = $admService;
    $this->_authService = $authService;
  }

  public function getAll()
  {
  }

  /**
   * Método para criar um novo administrador a partir dos dados fornecidos no corpo da solicitação.
   *
   * @return string Resposta JSON com o resultado da criação do administrador.
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
      $this->_admService->create($adm);

      // Define a resposta JSON de sucesso.
      $response = ResponseBuilder::success(
        "Administrador(a) cadastrado(a) com sucesso.",
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
   * Método para autenticar um administrador com base nas credenciais fornecidas no corpo da solicitação.
   *
   * @return string Resposta JSON com o resultado da autenticação do administrador.
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
