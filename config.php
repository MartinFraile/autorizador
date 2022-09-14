<?php

// config.php
define("HOMEDIR", "c:/wamp64/www/autorizador");
define("CLASES_LOCAL", HOMEDIR . "/clases");
define('CLAVE_PRINCIPAL', $_SERVER['SERVER_NAME']);
define("AUTORIZADOR",1);

//$_SESSION[CLAVE_PRINCIPAL]['db_mysql'] = array(
//    'phptype' => 'mysql',
//    'host' => '200.58.96.222',
//    'db_name' => 'bd_confiar_dev',
//    'user' => 'uid_torreon',
//    'passwd' => 'Mermelada.IBL#01',
//    );

$_SESSION[CLAVE_PRINCIPAL]['db_mysql'] = array(
    'phptype' => 'mysql',
    'host' => 'localhost',
    'db_name' => 'bdsistemas',
    'user' => 'root',
    'passwd' => '',
    );

$_SESSION[CLAVE_PRINCIPAL][AUTORIZADOR] = array(
    'entidad' => 'AUTORIZADOR',    
    );

$_SESSION[CLAVE_PRINCIPAL]['pdfconec'] =  [
   'driver'   => 'mysql',
    'username' => 'uid_torreon',
    'password' => 'Mermelada.IBL#01', //'Whal97.qqsclan',
    'host' => '200.58.96.222',
    'database' => 'bd_confiar_dev'    ,
    'jdbc_dir' => HOMEDIR . '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc',
    'jdbc_driver' => 'com.mysql.cj.jdbc.Driver',
    'jdbc_url' => 'jdbc:mysql://200.58.96.222:3305;databaseName=bd_confiar_dev?useSSL=false', 
];

$_SESSION["CONFIAR"]['mail'] = array(
    'mail'       => 'pagopordiaconfiar@gmail.com',
    'mail_alias' => 'CONFIAR',
    //  'mail_pass'  => 'cuhrfwcctotatzpm',
    'mail_host'  => 'smtp.gmail.com',
    'mail_port'  => '587',
    'mail_reply' => 'pagopordiaconfiar@gmail.com',
    'app_pass'   => 'cuhrfwcctotatzpm',
);
