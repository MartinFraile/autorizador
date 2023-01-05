<?php
 session_start();
require_once("../config.php");
require_once("../clases/DB.php");
require_once("../clases/funciones.php");
function buscar_practicaodont($html_codigo_id, $tipo = "", $datosform){

 $codigo = leerentrada($html_codigo_id); 
 $cod_obsoc = $datosform['cod_obsoc']; 
  if($codigo!="" && $cod_obsoc > 0 )
  {

    $obsocSess = $_SESSION['cod_obsoc'];
    $cod_obsocConec = (isset($datosform['cod_obsocconec'])) ? $datosform['cod_obsocconec'] :  $_SESSION['cod_obsoc'];           
    $_SESSION['cod_obsoc'] = $cod_obsocConec ;

      $error = DB::Connect(); 
      if ($error) die($error); 

      $columns = array('cod_practi, descripcion, codnum, cod_imgp, cod_imgg, tipotrod, codsegmento, piezasn, carasn, mjeprac');                
      if (is_Numeric($codigo)){
        $where = array( "codnum" => $codigo , "obsociales_id"=> $cod_obsoc );
        $datos = DB::Select('whal.buspractiodont', $columns, $where);
      }
      else{
        $where = "descripcion like '%".$codigo."%' and obsociales_id = ". $cod_obsoc ." ";
        $datos = DB::Select('whal.buspractiodont', $columns, $where);
      }

   
      if($tipo == "json")
      {
        $_SESSION['cod_obsoc'] = $obsocSess;
        return json_encode($datos);
      }   
      
  }
  else
  {
        echo "$('#desc_".$html_codigo_id."').val('');";
        echo "  setTimeout(function (){waitingDialog.hide();}, 500);";       
  }
  
  }
?>
