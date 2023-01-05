<?php
 session_start();
require_once("../config.php");
require_once("../clases/DB.php");
require_once("../clases/funciones.php");
function buscar_afiliadonro($html_codigo_id, $tipo = "", $datosform){

 $codigo = leerentrada($html_codigo_id); 
 $cod_obsoc = $datosform['cod_obsoc']; 
 $datos = [];

  if($codigo!="" && $cod_obsoc > 0 )
  {
      $error = DB::Connect(); 
      if ($error) die($error); 


      if (is_Numeric($codigo)){
        $sql = 'EXEC  whal.qrydatosbenef :tipo, :search, :cod_obsoc;';
        $values = array('tipo' => 1,'search' => $codigo,'cod_obsoc' => $cod_obsoc);
        $datos = DB::Query($sql, $values); 
      }     
      if($tipo == "json")
      {
        return json_encode($datos);
      }   
      
  }
  else
  {
        echo "$('#desc_".$html_codigo_id."').val('');";
        echo "  setTimeout(function (){waitingDialog.hide();}, 1000);";   
    
  }
  
  }
?>
