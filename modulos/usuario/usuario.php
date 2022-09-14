<?php

session_start();
require_once "../../config.php";

include '../../vendor/autoload.php';
require_once CLASES_LOCAL . "/funciones.php";


class usuario
{
  private $homedir;
  // propiedades de la clase
  private $tabla;
  private $campos_lst;
  private $campo_codigo;
  private $ruta;
  private $cantregistros;
  private $tipolist;

  public function __construct()
  {
    $this->homedir = HOMEDIR;
    $this->tabla         = 'whal.olbenef';
    $this->campo_codigo  = "nro_documento";
    $this->codigo        = leerentrada($this->campo_codigo);
    $this->ruta          = "modulos/usuario";
    $this->cantregistros = 15;
    $this->campos_lst = array(
    );

  }

  public function login($entrada)
  {
    $_SESSION['cod_agencia'] = 1;
    require_once CLASES_LOCAL . "/personal.php";
    $personal = new personal();
    $error = $personal->login();
    die(json_encode($error));
  }

  public function __destruct()
  {
  }
}
