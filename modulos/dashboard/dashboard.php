<?php

session_start();

$file_path = dirname(dirname(__FILE__));
require_once $file_path . "../../config.php";
include HOMEDIR . '/vendor/autoload.php';
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";
require_once CLASES_LOCAL . "/personal.php";
require_once CLASES_LOCAL . "/setup_smarty.php";

class dashboard
{
    private $homedir;
    // propiedades de la clase
    private $tabla;
    private $campos_lst;
    private $campo_codigo;
    private $ruta;
    private $cantregistros;
    private $tipolist;
    private $absolute_path;
    private $smarty;

    public function __construct()
    {

        $this->homedir = HOMEDIR;
        $this->ruta    = "modulos/dashboard";
        $login         = new personal();
        $error         = $login->islogin();
        $error         = DB::Connect();
        if ($error) {
            die($error);
        }
         $this->smarty          = new Smarty_Whal();
        $this->smarty->caching = false;
        $this->smarty->assign('ruta', $this->ruta);

    }

    public function get_dashboard()
    { 

        header("Location: /inicio");
        exit;

    }

    public function get_home($entrada)
    {
      
        switch ($entrada['menu']) {
            case "home":
                $cod_menupadre = 2;
                $active        = "Home";
                break;
            case "ambulatorias":
                $cod_menupadre = 3;
                $active        = "Ambulatorias";
                break;
            case "internaciones":
                $cod_menupadre = 4;
                $active        = "Internaciones";
                break;
            case "herramientas":
                $cod_menupadre = 6;
                $active        = "Herramientas";
                break;
            
        }

        $where = array("habilitado" => 1, "cod_menupadre" => $cod_menupadre);
        $datos = DB::Select("menuaut", "*", $where, "orden ASC" );
        
        $filterDatos = [];
        foreach ($datos as $key => $valor) {
            if (permisoempresa($valor['empresas_hab']) == 1) {
                if (permisomenu($_SESSION['cod_clase'], $valor['clases_opera']) == 1) {
                    array_push($filterDatos, $datos[$key]);
                }
            }
        }

        //die(var_dump($filterDatos));
        $this->smarty->assign('datos', $filterDatos);

        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->assign('active', $active);        
        $this->smarty->display(HOMEDIR . '/tpl/home.tpl');

    }

   

    public function __destruct()
    {
    }
}
