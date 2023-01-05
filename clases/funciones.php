<?php
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

function fnccomboDB(
    $tabla,
    $campo_clave,
    $campo_descripcion,
    $campo_order,
    $where = null,    
    $onlyDesc = false
) {

    $db_funciones = DB::Select($tabla, "*", $where, $campo_order);
   
        foreach ($db_funciones as $id => $valor) {
        $funciones[$valor[$campo_clave]] = $valor[$campo_clave] . " - " . $valor[$campo_descripcion];
        if ($onlyDesc) $funciones[$valor[$campo_clave]] = $valor[$campo_descripcion];
    }
    return $funciones;
}
function fnccomboDBConect(
    $tabla,
    $campo_clave,
    $campo_descripcion,
    $campo_order,
    $where = null,    
    $onlyDesc = false
) {
    $error = DB::ConnectMysql();
    if ($error) die($error);
    
    $db_funciones = DB::Select($tabla, "*", $where, $campo_order);
    
        foreach ($db_funciones as $id => $valor) {
        $funciones[$valor[$campo_order]] = $valor[$campo_clave] . " - " . $valor[$campo_descripcion];
       if ($onlyDesc) $funciones[$valor[$campo_clave]] = $valor[$campo_descripcion];
    }   
    return $funciones;
}
function fnccargachk(
    $tabla,
    $campo_clave,
    $campo_descripcion,
    $campo_order,
    $where = null
) {
    $columns = array($campo_clave, $campo_descripcion);
    $rows    = DB::Select($tabla, $columns, $where);
    $array   = DB::ConvertQueryToSimpleArray($rows, $campo_descripcion, $campo_clave);
    return $array;
}

//define function name
function m_log($arMsg, $nameLog)
{
    //get the event occur date time,when it will happened
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $arLogData['event_datetime'] = '[' . date('Y-m-d H:i:s') . ']';
    $stEntry                     = $arLogData['event_datetime'];
    //if message is array type
    if (is_array($arMsg)) {
        //concatenate msg with datetime
        foreach ($arMsg as $msg) {
            $stEntry .= " " . $msg;
        }
    } else {
        //concatenate msg with datetime
        $stEntry .= " " . $arMsg;
    }
    $stEntry .= PHP_EOL;

    //open the file append mode,dats the log file will create day wise
    $fHandler = fopen(HOMEDIR . '/logs/' . $nameLog . '.txt', 'a+');
    //write the info into the file
    fwrite($fHandler, $stEntry);
    //close handler
    fclose($fHandler);
}

function fncgrabalog($dbh, $operador, $consulta)
{

    $strsql = " insert into whal.TLog ( operador,Consulta) VALUES ( ";
    $strsql .= " '" . $operador . "' , '" . $consulta . "'  ) ";

    return $dbh->query($strsql);
}

function fncbuscoreg(
    $dbh,
    $tabla,
    $listacampo,
    $where = null,
    $listacampo_order,
    $limitereg = 0
) {

    $strsql = "select " . $listacampo . " from " . $tabla . " ";
    $strsql .= ($where != null) ? " where " . $where : " ";
    $strsql .= " order by " . $listacampo_order . " ";
    $strsql .= ($limitereg != 0) ? " limit " . $limitereg : " ";

    $resultado = $dbh->queryAll($strsql);
    if (count($resultado) == 1 and count($resultado[0]) == 1) {
        return $resultado[0][$listacampo];
    } else {
        return $resultado;
    }
}

function isHTML($string)
{
    return $string != strip_tags($string) ? true : false;
}

function fecha($fecha)
{
    $hora = "";
    if ($fecha == '0000-00-00') {
        return '';
    }

    if (substr($fecha, 2, 1) == '/') {
        if (strlen($fecha) > 10) //VIENE CON HORA: 01/12/2010 19:30:45
        {
            list($fecha, $hora) = explode(' ', $fecha);
            $hora               = ' ' . $hora;
        }

        $datos = explode('/', $fecha);
        return $datos[2] . '-' . $datos[1] . '-' . $datos[0] . $hora;
    } else
    if (substr($fecha, 4, 1) == '-') {
        if (strlen($fecha) > 10) //VIENE CON HORA: 2010-12-01 19:30:45
        {
            list($fecha, $hora) = explode(' ', $fecha);
            //$hora = ' '.$hora;
        }

        $datos = explode('-', $fecha);
        return $datos[2] . '/' . $datos[1] . '/' . $datos[0] . ' ' . $hora;
    } else {
        //return $fecha.' - Formato de fecha invalido';
        return '&nbsp;';
    }
}
function decimales($numero, $decimales = null)
{
    return number_format($numero, $decimales);
}
function leerentrada($clave, $snobligatorio = false)
{

    if (isset($_GET['param'])) {
        $entrada = base64_decode($_GET['param']);
        parse_str($entrada, $entrada);
        if (isset($entrada[$clave])) {
            return $entrada[$clave];
        }
    };
    if (isset($_GET[$clave])) {
        return $_GET[$clave];
    } elseif (isset($_POST[$clave])) {
        return $_POST[$clave];
    } elseif (isset($_REQUEST[$clave])) {
        return $_REQUEST[$clave];
    } elseif (isset($_FILES[$clave])) {
        return $_FILES[$clave];
    } else
    if ($snobligatorio) {
        die("El valor " . $clave . ", no trae datos");
    } else {
        return "";
    }
}


function DesEncriptarCadena($cadena)
{

    $cadenadesencriptada = "";
    for ($x = 0; $x < (strlen($cadena)); $x++) {
        $car = substr($cadena, $x, 1);
        $cadenadesencriptada .= DesEncriptarCaracter($car, strlen($cadena), $x);
    }
    return $cadenadesencriptada;
}
/**
 * desencripta caracteres
 * @param [type] $caracter    [description]
 * @param [type] $largocadena [description]
 * @param [type] $posicion    [description]
 */
function DesEncriptarCaracter($caracter, $largocadena, $posicion)
{
    $patron_encripta = utf8_decode('B8ÑCyEF0GrsHKLMij7N1OPopQRST3VW2XklYZ4ab5cef6ghmnIJñqtvAwxzD9d');
    $patron_busqueda = utf8_decode('C7rsGtv89HK34LMPQRSTVWzXYcdefZNFIJOabghijklmnñopqwxAy125B60DEÑ');

    if (strpos($patron_encripta, $caracter) > -1) {
        if (((strpos($patron_encripta, $caracter) + 1) - $largocadena - $posicion) > 0) {
            $indice = (strpos($patron_encripta, $caracter) - $largocadena - $posicion) % strlen($patron_encripta);
        } else {            
            $indice = (strlen($patron_busqueda) + ((strpos($patron_encripta, $caracter) - $largocadena - $posicion) % strlen($patron_encripta)));
        }
        $indice = $indice % strlen($patron_encripta);

        return substr($patron_busqueda, $indice - 1, 1);
    } else {
        return $caracter;
        //   return '*';
    }
}
function getStringBetween($content, $start, $end)
{
    $r = explode($start, $content);
    if (isset($r[1])) {
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

function fncnrocomprobante($tipocomprobante, $avanza = true)
{

    $campo         = array("prox_nro" => "CONCAT( LPAD(nro_compro1,4,'0'), '-',  LPAD(nro_compro2 + 1,8,'0')) ");
    $where         = array("tipo_comprobante" => $tipocomprobante, "cod_agencia" => $_SESSION['cod_agencia']);
    $proximonumero = DB::SelectValue("dttcompro", $campo, $where);


    if ($avanza != false) {
        $values = array('nro_compro2' => intval(substr($proximonumero, -8)));
        $where  = array("tipo_comprobante" => $tipocomprobante, "cod_agencia" => $_SESSION['cod_agencia']);
        $rows   = DB::Update("dttcompro", $values, $where);
    }

    return $proximonumero;
}

/**
 * Encripta un texto mediante una contrase�a
 * @param $mensage
 * @param $clave
 *
 * @return string
 */
function encriptar_con_clave($mensage, $clave)
{
    $textoEncriptado = '';
    settype($mensage, "string");
    $i = strlen($mensage) - 1;
    $j = strlen($clave);
    if (strlen($mensage) <= 0) {
        return '';
    }
    do {
        $textoEncriptado .= ($mensage[$i] ^ $clave[$i % $j]);
    } while ($i--);
    $textoEncriptado = base64_encode(base64_encode(strrev($textoEncriptado)));
    return $textoEncriptado;
}
/**
 * Desencripta un texto mediante una contrase�a
 * @param $mensaje
 * @param $clave
 *
 * @return string
 */
function desencriptar_con_clave($mensaje, $clave)
{
    $textoPlano = '';
    settype($mensaje, "string");
    $mensaje = base64_decode(base64_decode($mensaje));
    $i       = strlen($mensaje) - 1;
    $j       = strlen($clave);
    if (strlen($mensaje) <= 0) {
        return '';
    }
    do {
        $textoPlano .= ($mensaje[$i] ^ $clave[$i % $j]);
    } while ($i--);
    $textoPlano = strrev($textoPlano);
    return $textoPlano;
}
function permisomenu($clase_opera, $clases_opera)
{
    $clasesop = explode(',', $clases_opera);
    if (in_array($clase_opera, $clasesop)) {
        return 1;
    } else {
        return 0;
    }
}

function permisoempresa($empresas_habilitadas)
{
    $empresa_hab = explode(',', $empresas_habilitadas);
    if (in_array($_SESSION['cod_agencia'], $empresa_hab)) {
        return 1;
    } else {
        return 0;
    }
}
