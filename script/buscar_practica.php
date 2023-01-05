<?php
session_start();
require_once "../config.php";
require_once "../clases/DB.php";
require_once "../clases/funciones.php";
function buscar_practica($html_codigo_id, $tipo = "", $datosform)
{
    $codigo    = leerentrada($html_codigo_id);
    $cod_obsoc = $datosform['cod_obsocconec'];

    
    if ($codigo != "" && $cod_obsoc > 0) {

        $error = DB::Connect();
        if ($error) {
            die($error);
        }
        $columns = array('*');
        //$columns = array('Cod_Practi, Descripcion, CodNum, TNomenc_ID, Grupo_Coseguro, CodSegmento, LimiteEdad, CodSegAutOL, Cod_TipPre, mjeprac, ObSociales_id');
        if (is_Numeric($codigo)) {            
            $where = "codnum =". $codigo;
            if ($codigo != 430101 and $cod_obsoc ==14)
            {
                $where .= " and  Cod_TipPre in(1,2)  ";    
            }
            
            $datos = DB::Select('whal.ol_buspractica', $columns, $where);

        } else {
            $where = "descripcion like '%" . $codigo . "%' ";  
            if ($cod_obsoc ==14)
            {
                $where .= " and  Cod_TipPre in(1,2)  ";    
            }          
            $datos = DB::Select('whal.ol_buspractica', $columns, $where);
        }

        if ($tipo == "json")return json_encode($datos);

    } else {
       if ($tipo == "json") return json_encode(false);
        echo "$('#desc_" . $html_codigo_id . "').val('');";
        echo "  setTimeout(function (){waitingDialog.hide();}, 500);";
      
    }

}
