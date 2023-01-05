<?php
 // listar
  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->listar($_REQUEST);
