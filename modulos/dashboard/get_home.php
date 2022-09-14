
<?php
  require_once("dashboard.php");
  $obj = new dashboard();
  echo $obj->get_home($_REQUEST);
