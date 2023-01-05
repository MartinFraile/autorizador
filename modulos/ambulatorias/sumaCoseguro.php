<?php
  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->sumaCoseguro($_REQUEST);
