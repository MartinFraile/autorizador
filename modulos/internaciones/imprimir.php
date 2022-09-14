<?php
require_once "ambodont.php";
$obj = new ambodont();

if ($_REQUEST['accion'] == 'imprimir') {
  if ($_POST) {
  //  echo "$('#div_principal').html('Genero Listado');";
    echo " void window.open('/base/".$_REQUEST['ruta']."/imprimir.php?" . http_build_query($_POST) . "'); ";

  } else {
    echo $obj->imprimir($_REQUEST);
  }
}
