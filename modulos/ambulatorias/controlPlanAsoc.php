<?php
  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->controlPlanAsoc($_REQUEST);
