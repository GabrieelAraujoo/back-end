<?php

/**
 * Interface para representar um usuário.
 */
interface User
{

  /**
   * Obtém o ID do usuário.
   *
   * @return int O ID do usuário.
   */
  public function getId();

  /**
   * Define o ID do usuário.
   *
   * @param string $id O novo ID do usuário.
   */
  public function setId($id);

  /**
   * Obtém o nome do usuário.
   *
   * @return string O nome do usuário.
   */
  public function getNome();

  /**
   * Define o nome do usuário.
   *
   * @param string $nome O novo nome do usuário.
   */
  public function setNome($nome);

  /**
   * Obtém o email do usuário.
   *
   * @return string O email do usuário.
   */
  public function getEmail();

  /**
   * Define o email do usuário.
   *
   * @param string $email O novo email do usuário.
   */
  public function setEmail($email);

  /**
   * Obtém a senha do usuário.
   *
   * @return string A senha do usuário.
   */
  public function getSenha();

  /**
   * Define a senha do usuário.
   *
   * @param string $senha A nova senha do usuário.
   */
  public function setSenha($senha);

  /**
   * Obtém o tipo de usuário (aluno, admin).
   *
   * @return string O tipo de usuário.
   */
  public function getType();

  /**
   * Define o tipo de usuário (aluno, admin).
   *
   * @param string $type O tipo de usuário a ser definido.
   */
  public function setType($type);
}
