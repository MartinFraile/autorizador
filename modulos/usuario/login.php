<?php
 // listar
  require_once("usuario.php");
  $obj = new usuario();
  echo $obj->login($_REQUEST);
