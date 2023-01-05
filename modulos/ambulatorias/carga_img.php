<?php

  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->carga_img($_REQUEST);

