<?php
  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->modificar($_REQUEST);

