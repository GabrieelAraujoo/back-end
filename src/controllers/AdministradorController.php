<?php

require_once(__DIR__ . '/../services/AdministradorService.php');
require_once(__DIR__ . '/../helpers/ResponseBuilder.php');
require_once(__DIR__ . '/../models/Administrador.php');

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
  public function processarCadastroAdministrador()
  {
    try {
      $adm = new Administrador(
        $_POST['name'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['type']
      );

      // Chama o serviço para cadastrar o administrador.
      $this->_administradorService->cadastrarAdministradorService($adm);

      // Retorna uma resposta JSON de sucesso.
      return ResponseBuilder::successResponse('Administrador cadastrado com sucesso.');
    } catch (Exception $e) {

      // Retorna uma resposta JSON de erro.
      return ResponseBuilder::errorResponse('Erro de validação: ' . $e->getMessage());
    }
  }
}
