<?php
require_once "ambulatorias.php";
$obj = new ambulatorias();
echo $obj->agrega_adjunto($_REQUEST);

