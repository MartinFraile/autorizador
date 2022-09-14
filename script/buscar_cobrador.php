<?php
session_start();
require_once "../config.php";
require_once "../clases/DB.php";
require_once "../clases/funciones.php";
function buscar_cobrador($html_codigo_id, $tipo = "")
{

    $codigo = leerentrada($html_codigo_id);

    if ($codigo != "") {
        $error = DB::Connect();
        if ($error) {
            die($error);
        }

        $columns = array('*');
        if (is_Numeric($codigo)) {
            $where = array("nro_documento = $codigo  or cod_cobrador = $codigo", "cod_agencia" => $_SESSION['cod_agencia']);
            $datos = DB::Select('qrycobradores', $columns, $where);
        } else {
            $where = " cod_clase = 3 and  cod_agencia = " . $_SESSION['cod_agencia'] . " and apeynom LIKE '%" . $codigo . "%'";
            $datos = DB::Select('qrycobradores', $columns, $where);
        }

        if ($tipo == "json") {
            return json_encode($datos);
        }

    }

}
