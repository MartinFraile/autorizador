<?php
  require_once("ambulatorias.php");
  $obj = new ambulatorias();
  echo $obj->form_list_aut($_REQUEST);


