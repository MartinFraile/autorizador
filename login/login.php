<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require_once "../config.php";
require_once CLASES_LOCAL . "/personal.php";

$_SESSION['cod_agencia'] = AUTORIZADOR;

$personal = new personal();

$error = $personal->login();

if ($error == false) {
    echo '<script>';
    echo "window.location='login.html?usuario=incorrecto';";    
    echo '</script>';    
    echo ' <div class="alert success" style="animation: fadein 0.5s;text-align-last: center;"><h2>Usuario Incorrecto"</h2></div>';
    
} else {    
     header("Location: /inicio");
     exit;
  
}
