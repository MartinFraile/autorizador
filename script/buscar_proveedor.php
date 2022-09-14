<?php
session_start();
require_once "../config.php";
require_once "../clases/DB.php";
require_once "../clases/funciones.php";
function buscar_proveedor($html_codigo_id, $tipo = "")
{

    $codigo = leerentrada($html_codigo_id);

    if ($codigo != "") {
        $error = DB::Connect();
        if ($error) {
            die($error);
        }

        $columns = array('*');
        if (is_Numeric($codigo)) {
            $where = array("nro_documento" => $codigo, "cod_agencia" => $_SESSION['cod_agencia']);
            $datos = DB::Select('qryproveedores', $columns, $where);
        } else {
            $where = "  cod_agencia = " . $_SESSION['cod_agencia'] . " and apeynom LIKE '%" . $codigo . "%'";
            $datos = DB::Select('qryproveedores', $columns, $where);
        }

        if ($tipo == "json") {
            return json_encode($datos);
        }

    }

}
