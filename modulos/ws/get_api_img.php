<?php
  require_once("actomed.php");
  $obj = new actomed();
  echo $obj->get_api_img($_REQUEST);

