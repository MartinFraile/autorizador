<?php
  require_once("internaciones.php");
  $obj = new internaciones();
  echo $obj->form_list_liq($_REQUEST);

