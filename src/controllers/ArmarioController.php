<?php

require_once(__DIR__ . '/../interfaces/Controller.php');
class ArmarioController implements Controller
{
  private $_armarioService;

  public function __construct(ArmarioService $armarioService)
  {
    $this->_armarioService = $armarioService;
  }

  public function getAll()
  {
  }

  public function create()
  {
  }

  public function update()
  {
  }

  public function delete()
  {
  }
}
