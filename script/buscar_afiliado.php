<?php

session_start();
require_once("../config.php");
require_once("../clases/DB.php");
require_once("../clases/funciones.php");
require_once("../modulos/ws/actomed.php");
function buscar_afiliado($html_codigo_id, $tipo = "", $datosform){
 
 $codigo = leerentrada($html_codigo_id); 
 $cod_obsoc = $datosform['cod_obsoc']; 


  if($codigo!="" && $cod_obsoc > 0 )
  {
    
      $cod_obsocConec = (isset($datosform['cod_obsocconec'])) ? $datosform['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
      $obsocSess = $_SESSION['cod_obsoc'];
      $_SESSION['cod_obsoc'] = $cod_obsocConec ;

      $error = DB::Connect(); 
      if ($error) die($error); 
      
      if (is_Numeric($codigo)){

          if ($cod_obsocConec == 14){
           
            $obj = new actomed();  
            $pram = array("nro_afil" => $codigo);  
            $tipo = "json";     
            $datos = $obj->afil_iapos($pram);
              // die('lleg');
           // die('llego'.json_encode($datos));
            //$datos = array("Badocnumdo" => $dato['nrodoc'], "nro_afil" => $dato['Nafiliado'],);

          }
          else 
          {
           $sql = 'EXEC  whal.qrydatosbenef :tipo, :search, :cod_obsoc '.((($datosform['cod_obsocconec']) ==7) ? ', 1' :  '');
           $values = array('tipo' => 1,'search' => $codigo,'cod_obsoc' => $cod_obsoc);
           $datos = DB::Query($sql, $values); 
          }

      }
      else{
        $sql = 'EXEC  whal.qrydatosbenef :tipo, :search, :cod_obsoc '.((($datosform['cod_obsocconec']) ==7) ? ', 1' :  '');
        $values = array('tipo' => 0,'search' => $codigo,'cod_obsoc' => $cod_obsoc);
        $datos = DB::Query($sql, $values); 
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
        echo "  setTimeout(function (){waitingDialog.hide();}, 1000);";   
    
  }
  
  }
?>
