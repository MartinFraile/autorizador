<?php
 session_start();
require_once("../config.php");
require_once("../clases/DB.php");
require_once("../clases/funciones.php");
function buscar_prescriptor($html_codigo_id, $tipo = ""){

 $codigo = leerentrada($html_codigo_id); 

  if($codigo!="")
  {
      $error = DB::Connect(); 
      if ($error) die($error); 


      $columns = 'matricula as matpres , *';                
      if (is_Numeric($codigo)){
        $where = array( "matricula" => $codigo );
        $datos = DB::Select('whal.ol_busmed', $columns, $where);
      }
      else{
        $where = "apellidos like '%".$codigo."%'";
        $datos = DB::Select('whal.ol_busmed', $columns, $where);        
      }

      if($tipo == "json")
      {
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
