<?php
require_once "internaciones.php";
$obj = new internaciones();
 
   if (isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'imprimir' ) {
    $_REQUEST['accion'] = '';
    echo " void window.open('/base/".$_REQUEST['ruta']."/imprimeOrden.php?param=" .base64_encode( http_build_query($_REQUEST) ). "'); ";

  } else {
    echo $obj->imprimeOrden($_REQUEST);
  }
