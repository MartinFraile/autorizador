<?php
require_once "ambulatorias.php";
$obj = new ambulatorias();
echo $obj->consulta_aut($_REQUEST);

