<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->carga_img($_REQUEST);

