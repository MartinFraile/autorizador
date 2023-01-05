<?php

  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->list_buscar_aut($_REQUEST);


