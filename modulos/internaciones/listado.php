<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->grid($_REQUEST);

