<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->carga_asoc($_REQUEST);

