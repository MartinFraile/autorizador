<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->valida_ingresa($_REQUEST);


