<?php
  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->validaOd($_REQUEST);
