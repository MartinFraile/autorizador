<?php
  require_once("persona.php");
  $obj = new persona();
  echo $obj->modificar($_REQUEST);
