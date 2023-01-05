<?php
// clase personal.php
//session_start();
require_once "DB.php";
require_once "funciones.php";
define('CLAVE_API', "RmiuAñLHiL");
define('CODIFICADOR', 'oKUEL4iIJ9NdECsX');

class personal
{
    private $db;
    public $cod_clase;
    public $clase_opera;
    public $nomusuario;
    public $cod_usuario;

    public function __construct()
    {
        $error = DB::ConnectMysql();
        if ($error) {
            die($error);
        }
    }

    public function login()
    {

        $where = array("nroingreso" => $_POST["usuario"], "claveope" => $_POST["contrasena"], "activosn" => 1);
        return $this->checkUser($where);

    }

    public function cod_usuario()
    {
        return $this->cod_usuario;
    }

    public function islogin()
    {
        if ($this->autorizar()) {
            return true;
        }
        if ($_COOKIE["usuario"]) {
            return true;
        } else {
            $this->unlogin();
            //die("El usuario no esta logueado");
        }

    }

    public function autorizar()
    {
        if (isset($_COOKIE['user-id'])) {
            $userId = desencriptar_con_clave($_COOKIE['user-id'], CODIFICADOR);

            $userId   = preg_split("/;/", $userId);
            $data     = array("contrasena" => $userId[0], "codigo" => $userId[1], "cod_agencia" => $userId[2]);
            $userData = $this->checkUser($data, $userId[2]);
            return $userData;
        }

        $cabeceras = apache_request_headers();

        if (isset($cabeceras["claveapi"]) && isset($cabeceras["cod_obsoc"])) {
            $claveApi = $cabeceras["claveapi"];
            if ($claveApi == CLAVE_API) {
                $_SESSION['cod_club'] = $cabeceras["cod_club"];
                return true;
            } else {
                die("Parámetros inválidos");
                return false;
            }

        } else {
            //  die("Parámetros inválidos");
            return false;
        }
    }
    public function unlogin()
    {
        setcookie("usuario", "", time() - 3600, '/');
        setcookie("nro_doctit", "", time() - 3600, '/');
        setcookie("cod_plan", "", time() - 3600, '/');
        setcookie("nroafil", "", time() - 3600, '/');

        unset($_SESSION);
        unset($_COOKIE);
        $camino = "/login/index.php";
        header("Location: " . $camino . "");
        die();

    }

    public function checkUser($where = array(), $codAgencia = null)
    {
        if (!empty($where)) {

            $usuario = DB::SelectRow('autoperadores', "*", $where);
            
            if (!$usuario) {
                return false;
            }

            if (isset($usuario["nroingreso"])) {
                setcookie("usuario", $usuario["nroingreso"], time() + 72240, '/');
                setcookie("operadores_id", $usuario["operadores_id"], time() + 72240, '/');
                $_SESSION['nroingreso']      = $usuario["nroingreso"];
                $_SESSION['nomope']          = $usuario["nomope"];
                $_SESSION['cod_clase']   = '1';
                $_SESSION['operadores_id']   = $usuario["operadores_id"];
                $_SESSION['cod_sucursal']    = $usuario["cod_sucursal"];                 
                $_SESSION['cod_agencia']     =  '1';//$usuario["cod_agencia"];
                //$_SESSION['pdfconec']        = $usuario["pdfconec"];
                $this->nomusuario            = $usuario["nomope"];
                $this->cod_usuario           = $usuario["nroingreso"];
                $this->getMenu();

                $userId = encriptar_con_clave($usuario['claveope'] . ";" . $usuario['nroingreso'] . ";" . $_SESSION['cod_agencia'], CODIFICADOR);

                setcookie("user-id", $userId, time() + 31556926, '/'); // where 31556926 is total seconds for a year.

                return $usuario;
            } else {
                return false;
            }

        }

        // Return user data
        return !empty($usuario) ? true : false;
    }

    public function getMenu()
    {
        $where = array("habilitado" => 1, "cod_menupadre" => 999);
        $datos = DB::Select("menuaut", "*", $where, "orden ASC");

        $filterDatos = [];
        foreach ($datos as $key => $valor) {
            if (permisoempresa($valor['empresas_hab']) == 1) {

                if (permisomenu($_SESSION['cod_clase'], $valor['clases_opera']) == 1) {
                    array_push($filterDatos, $datos[$key]);
                }
            }
        }
        $_SESSION['menu'] = $filterDatos;
    }

 
}
