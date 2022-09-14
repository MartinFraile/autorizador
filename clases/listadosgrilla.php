<?php
//session_start();

class listadosgrilla
{
  function __construct()
  {
  }


  function pModificarApp($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta = $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'modificar') ? $columna["opciones"]["script"] : 'modificar';

    $basename = basename($ruta);

    $mostrar = "/" . $basename . "/" . $script . "?param=" . $param . " ";

    $url = "<a class='' href='" . $mostrar . "' >";
    $url .= "<img src='/img/editar.svg'  alt='Editar'
            height='25px'  width='35px'  /></a>";
    return $url;
  }

  function pModificar($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta = $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'modificar') ? $columna["opciones"]["script"] : 'modificar';

    //$mostrar = " javascript:link_ajax('".$ruta."/".$script.".php?param=" . $param . "','".$div."','form');";
    $mostrar = $ruta . "/" . $script . "?param=" . $param;

    $url = "<a class='' href='" . $mostrar . "' >";
    $url .= "<img src='/img/editar.svg'  alt='Editar'
            height='25px'  width='35px'  /></a>";
    return $url;
  }
  function pImp($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta =  $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'listar') ? $columna["opciones"]["script"] : 'listar';

    $mostrar = " javascript:void window.open('" . $ruta . "/" . $script . ".php?param=" . $param . "','div_principal','','form','','si', '_blank');";

    $url = '<a class="" href="' . $mostrar . '" >';
    $url .= '<img src="/img/printer.svg"  alt="Imprimir"
    		height="25px"  width="30px" /></a>';
    return $url;
  }

  function pMail($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta =  $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'listar') ? $columna["opciones"]["script"] : 'listar';

    $mostrar = " javascript:void window.open('" . $ruta . "/" . $script . ".php?param=" . $param . "','div_principal','','form','','si', '_blank');";

    $url = '<a class="" href="' . $mostrar . '" >';
    $url .= '<img src="/img/email.svg"  alt="Enviar"
    		height="25px"  width="30px" /></a>';
    return $url;
  }
  function chkbutton($columna, $registro)
  {

    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }
    $tipo = "";
    if (isset($columna["tipo"])) {
      $tipo = "&tipo=" . $columna["tipo"];
    };
    $checked =  ($valores_campos[$columna["name"]]["valor"] == '1')  ? 'checked' : '';
    $js = $columna['opciones']['jsfunc'];
    $mostrar = "javascript: " . $js;
    $mostrar = '<input type="checkbox" value="' . $valores_campos[$columna["name"]]["valor"] . '"  name="chkSelec[]" id="chkSelec[]" onclick="' . $mostrar . '" ' . $checked . ' / >';

    return $mostrar;
  }

  function pSeleccionar($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta = $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'seleccionar') ? $columna["opciones"]["script"] : 'seleccionar';

    $mostrar = " javascript:link_ajax('" . $ruta . "/" . $script . ".php?param=" . $param . "','" . $div . "','form');";

    $url = '<a class="" href="' . $mostrar . '" >';
    $url .= '<img src="/img/flechadoble.svg"  alt="Seleccionar"
            height="25px"  width="30px" /></a>';
    return $url;
  }
  function pEliminar($columna, $registro)
  {
    //die(json_encode($registro));
    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta = $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'modificar') ? $columna["opciones"]["script"] : 'modificar';

    //$mostrar = " javascript:link_ajax('".$ruta."/".$script.".php?param=" . $param . "','".$div."','form');";
    $mostrar = $ruta . "/" . $script . "?param=" . $param;

    $url = '<a class="" href="' . $mostrar . '" >';
    $url .= '<img src="/img/eliminar.svg"  alt="Eliminar"
            height="25px"  width="30px" /></a>';
    return $url;
  }


  function pAcciones($columna, $registro)
  {

    $param = htmlentities(base64_encode(http_build_query($registro)));
    $campos_buscar = $columna['opciones']['campos'];
    $valores_campos = array();
    if (is_array($campos_buscar)) {
      foreach ($campos_buscar as $nom_campo_buscar => $opciones) {
        $valores_campos[$nom_campo_buscar] = $opciones;
        $valores_campos[$nom_campo_buscar]['valor'] = $registro[$nom_campo_buscar];
      }
    }

    $ruta = $columna["ruta"];
    $div =  ($columna["opciones"]["div"] !== 'div_principal') ? $columna["opciones"]["div"] : 'div_principal';
    $script =  ($columna["opciones"]["script"] !== 'modificar') ? $columna["opciones"]["script"] : 'modificar';

    //$mostrar = " javascript:link_ajax('".$ruta."/".$script.".php?param=" . $param . "','".$div."','form');";
    //  $mostrar = $ruta . "/" . $script . "?param=" . $param;

    $url = "";
    $acciones = $columna["opciones"]["acciones"];
    foreach ($acciones as $clave => $valor) {
      $ruta =  $valor['ruta'];
      switch ($clave) {
        case 'editar':
          $mostrar =  "/".$ruta .  "/modificar?param=" . $param;
          $url .= "<a class='' href='" . $mostrar . "' >";
          $url .= "<span class='tooltiptext'>Editar</span>";       
          $url .= "<img src='/img/editar-color.svg'  alt='Editar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'eliminar':            
          $url .= "<a class=''  href=# onclick='eliminar(&apos;$param&apos;) ;' \>";          
          $url .= "<span class='tooltiptext'>Eliminar</span>";          
          $url .= "<img src='/img/eliminar-color.svg'  alt='Eliminar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'eliminarcuo':
          $url .= "<a class=''  href=# onclick='eliminarcuo(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Eliminar</span>";
          $url .= "<img src='/img/eliminar-color.svg'  alt='Eliminar'
            height='25px'  width='35px'  /></a>";
          break;  
        case 'cierre':
          $url .= "<a class='' href=# onclick='cierre(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Cerrar Venta</span>";       
          $url .= "<img src='/img/cierre-color.svg'  alt='Cerrar'
            height='25px'  width='35px'  /></a>";
          break;  
        case 'genera':
          $url .= "<a class='' href=# onclick='genera(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Genera Cuotas</span>";       
          $url .= "<img src='/img/generar-color.svg'  alt='Cerrar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'listar':
          $url .= "<a class='' href=# onclick='listar(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Lista Venta</span>";
          $url .= "<img src='/img/printer.svg'  alt='Listar'
            height='25px'  width='35px'  /></a>";
          break;  

          case 'cobrar':
          $url .= "<a class='' href=# onclick='cobrar(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Cobrar Cuotas</span>";       
          $url .= "<img src='/img/cobrar-color.svg'  alt='Cerrar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'cerrarcuenta':
          $url .= "<a class='' href=# onclick='cerrarcuenta(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Cierra Cuenta</span>";
          $url .= "<img src='/img/cierre-color.svg'  alt='Cerrar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'aceptapresu':
          $url .= "<a class='' href=# onclick='aceptapresu(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Acepta</span>";
          $url .= "<img src='/img/checkok-color.svg'  alt='Aceptar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'rechazapresu':
          $url .= "<a class='' href=# onclick='rechazapresu(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Rechaza</span>";
          $url .= "<img src='/img/cruz-color.svg'  alt='Rechazar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'listarpresu':
          $url .= "<a class='' href=# onclick='listarpresu(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Lista</span>";
          $url .= "<img src='/img/printer.svg'  alt='Listar'
            height='25px'  width='35px'  /></a>";
          break;
        case 'editarpresu':
          $url .= "<a class='' href=# onclick='editarpresu(&apos;$param&apos;) ;' \>";
          $url .= "<span class='tooltiptext'>Editar</span>";
          $url .= "<img src='/img/editar-color.svg'  alt='Cerrar'
            height='25px'  width='35px'  /></a>";
          break;
      
      }
    }

    return $url;
  }
}
