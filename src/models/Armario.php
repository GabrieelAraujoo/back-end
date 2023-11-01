<?php


/**
 * Classe que representa um armário.
 * 
 * Esta classe contém propriedades correspondentes à coluna da tabela 'armarios' no banco de dados.
 * É frequentemente usada para mapear registros de banco de dados para objetos na linguagem de programação.
 */
class Armario
{
  /**
   * @var int $_id O ID do armário.
   */
  private $_id;

  /**
   * @var string $_letra A letra associada ao armário.
   */
  private $_letra;

  /**
   * @var int $_numero O número associado ao armário.
   */
  private $_numero;

  /**
   * @var string $_status O status do armário.
   */
  private $_status;

  /**
   * @var string $_localization A localização do armário.
   */
  private $_localization;

  /**
   * Construtor da classe Armario.
   *
   * @param string $letra A letra associada ao armário.
   * @param int $numero O número associado ao armário.
   * @param string $localization A localização do armário.
   */
  public function __construct($letra, $numero, $localization)
  {
    $this->_letra = $letra;
    $this->_numero = $numero;
    $this->_localization = $localization;
  }

  /**
   * Obtém o ID do armário.
   *
   * @return int O ID do armário.
   */
  public function getId()
  {
    return $this->_id;
  }

  /**
   * Define o ID do armário.
   *
   * @param int $id O novo ID do armário.
   */
  public function setId($id)
  {
    $this->_id = $id;
  }

  /**
   * Obtém a letra associada ao armário.
   *
   * @return string A letra associada ao armário.
   */
  public function getLetra()
  {
    return $this->_letra;
  }

  /**
   * Define a letra associada ao armário.
   *
   * @param string $letra A nova letra associada ao armário.
   */
  public function setLetra($letra)
  {
    $this->_letra = $letra;
  }

  /**
   * Obtém o número associado ao armário.
   *
   * @return int O número associado ao armário.
   */
  public function getNumero()
  {
    return $this->_numero;
  }

  /**
   * Define o número associado ao armário.
   *
   * @param int $numero O novo número associado ao armário.
   */
  public function setNumero($numero)
  {
    $this->_numero = $numero;
  }

  /**
   * Obtém a localização do armário.
   *
   * @return string A localização do armário.
   */
  public function getLocalization()
  {
    return $this->_localization;
  }

  /**
   * Define a localização do armário.
   *
   * @param string $localization A nova localização do armário.
   */
  public function setLocalization($localization)
  {
    $this->_localization = $localization;
  }

  /**
   * Obtém o status do armário.
   *
   * @return string O status do armário.
   */
  public function getStatus()
  {
    return $this->_status;
  }

  /**
   * Define o status do armário.
   *
   * @param string $status O novo status do armário.
   */
  public function setStatus($status)
  {
    $this->_status = $status;
  }
}
