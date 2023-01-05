<?php

  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->get_afil($_REQUEST);

