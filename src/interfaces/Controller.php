<?php

/**
 * Interface para controladores.
 */
interface Controller
{
  /**
   * Obtém todos os recursos.
   *
   * @return string Resposta JSON com todos os recursos.
   */
  public function getAll();

  /**
   * Cria um novo recurso.
   *
   * @return string Resposta JSON com o resultado da criação do recurso.
   */
  public function create();

  /**
   * Atualiza um recurso.
   *
   * @return string Resposta JSON com o resultado da atualização do recurso.
   */
  public function update();

  /**
   * Exclui um recurso.
   *
   * @return string Resposta JSON com o resultado da exclusão do recurso.
   */
  public function delete();
}
