<?php
 // listar
  require_once("ambodont.php");
  $obj = new ambodont();
  echo $obj->listar($_REQUEST);
