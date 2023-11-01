<?php

/**
 * Interface para representar um armário.
 */
interface Tag
{
  /**
   * Obtém o ID da tag.
   *
   * @return int O ID da tag.
   */
  public function getId();

  /**
   * Define o ID da tag.
   *
   * @param int $id O novo ID da tag.
   */
  public function setId($id);

  /**
   * Obtém a letra associada à tag.
   *
   * @return string A letra associada à tag.
   */
  public function getLetra();

  /**
   * Define a letra associada à tag.
   *
   * @param string $letra A nova letra associada à tag.
   */
  public function setLetra($letra);

  /**
   * Obtém o número associado à tag.
   *
   * @return int O número associado à tag.
   */
  public function getNumero();

  /**
   * Define o número associado à tag.
   *
   * @param int $numero O novo número associado à tag.
   */
  public function setNumero($numero);

  /**
   * Obtém a localização da tag.
   *
   * @return string A localização da tag.
   */
  public function getLocalization();

  /**
   * Define a localização da tag.
   *
   * @param string $localization A nova localização da tag.
   */
  public function setLocalization($localization);
}
