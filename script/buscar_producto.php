<?php
 session_start();
require_once("../config.php");
require_once("../clases/DB.php");
require_once("../clases/funciones.php");
function buscar_producto($html_codigo_id, $tipo = ""){

 $codigo = leerentrada($html_codigo_id); 

  if($codigo!="")
  {
      $error = DB::Connect(); 
      if ($error) die($error); 


      $columns = array('*');                
      if (is_Numeric($codigo)){
        $where = array( "cod_producto" => $codigo );
        $datos = DB::Select('tproductos', $columns, $where);
      }
      else{
        $where = "desc_producto LIKE '%".$codigo."%'";
        $datos = DB::Select('tproductos', $columns, $where);
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
