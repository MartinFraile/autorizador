<?php

session_start();
require_once "../../config.php";
include '../../vendor/autoload.php';
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";
require_once CLASES_LOCAL . "/setup_smarty.php";

// persona.php
class persona
{
    private $homedir;
    // propiedades de la clase
    private $tabla;
    private $campos_lst;
    private $campo_codigo;
    private $ruta;
    private $cantregistros;
    private $tipolist;

    public function __construct()
    {
        $this->homedir = HOMEDIR;
        require_once CLASES_LOCAL . "/personal.php";
        $personal = new personal();
        $personal->islogin();
        $this->tabla        = 'mpersonas';
        $this->campo_codigo = "nro_documento";
        $this->codigo       = leerentrada($this->campo_codigo);
        $this->ruta         = "modulos/persona";
        $error              = DB::Connect();
        if ($error) {
            die($error);
        }
        $this->smarty          = new Smarty_Whal();
        $this->smarty->caching = false;        


    }

    public function modificar($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };


        if (leerentrada("accion") == 'guardar') {
            $this->save($_POST);
            $nro_documento = leerentrada("nro_documento");
            echo "$('#nro_documento').val('" . $nro_documento . "');";
            echo "bus_nro_documento(" . $nro_documento . ");";
            echo "callback();";
        } else {          
            if ($this->codigo > 0) {
                $where = array("tipo_documento" => $entrada['tipo_documento'] , "nro_documento" => $entrada['nro_documento']);
                $datos = DB::SelectRow("qrypersonas", "*", $where);
                $this->smarty->assign('datos', $datos);                                     
            }
            $this->smarty->assign('tipodoc', fnccomboDB("ttipodoc", "cod_tipodoc", "tipodoc", "cod_tipodoc","", true));
            $this->smarty->assign('localidad', fnccomboDB("tlocalidad", "cod_localidad", "desc_localidad","cod_localidad", "", true));
            $this->smarty->assign('titulo', 'Persona');
            $this->smarty->assign('ruta', $this->ruta);
            $codMaestro = $entrada['cod_maestro'] ?? '0';
            $this->smarty->assign('codMaestro', $codMaestro);
            $this->smarty->display('formulario.tpl');
        }
    }
    public function save($entrada)
    {
        $entrada['cod_agencia'] = $_SESSION['cod_agencia'];
        $json = json_decode($entrada['tablavalor'], true);



        DB::TransactionBegin();
        try {

            $success   = DB::InsertOrUpdate($this->tabla, $entrada);
            $where = array("tipo_documento" => $entrada['tipo_documento'], "nro_documento" => $entrada['nro_documento']);
            $success = DB::Delete("mdirecciones", $where);
            foreach ($json as $obj) {
                $success  = DB::InsertOrUpdate("mdirecciones", $obj);  
            }       
                         
        
            if ($success) {
                DB::TransactionCommit();
            }
        } catch (Exception $e) {
            // If there was a problem, rollback the transaction
            // as if no database actions here had ever happened
            DB::TransactionRollback();
            // Show the error
          //  die(var_dump($e->getMessage()));
        }

        if (!$success) {
             die('msgsnackbar("Error en Grabación", "warning");');
        }else {
             echo('msgsnackbar("Grabo correctamente", "success");');
        }


    }
    public function __destruct()
    {
    }
}
