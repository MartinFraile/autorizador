<?php
session_start();
require_once "../config.php";
require_once "../clases/DB.php";
require_once "../clases/funciones.php";
function buscar_cliente($html_codigo_id, $tipo = "")
{

    $codigo = leerentrada($html_codigo_id);

    if ($codigo != "") {
        $error = DB::Connect();
        if ($error) {
            die($error);
        }

        $columns = array('*');
        if (is_Numeric($codigo)) {
            require_once("actomed.php");
            $obj = new actomed();  
            $pram = array("nro_afil" => $codigo);
            $dato = $obj->afil_iapos($pram);
$datos = array("Badocnumdo" => $dato['nrodoc'], "nro_afil" => $dato['Nafiliado'],);

            $where = array("nro_documento = $codigo  or cod_maestro = $codigo", "cod_agencia" => $_SESSION['cod_agencia']);
            $datos = DB::Select('qryclientes', $columns, $where);
        } else {
            $where = "  cod_agencia = " . $_SESSION['cod_agencia'] . " and apeynom LIKE '%" . $codigo . "%'";
            $datos = DB::Select('qryclientes', $columns, $where);
        }

        if ($tipo == "json") {
            return json_encode($datos);
        }

    }

}
