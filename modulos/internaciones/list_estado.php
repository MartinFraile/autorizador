<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->list_estado($_REQUEST);


