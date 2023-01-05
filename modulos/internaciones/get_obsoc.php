<?php

  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->get_obsoc($_REQUEST);


