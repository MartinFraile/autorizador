<?php

 require_once ("../config.php");
 require_once("../clases/personal.php");
 $personal = new personal() ;
 $error =  $personal->unlogin();
