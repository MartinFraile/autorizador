<?php
if (!isset($_SESSION['LOGIN'])) {
    session_start();
}
require_once __DIR__ . "/../../config.php";
include HOMEDIR . '/vendor/autoload.php';
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";

class arba
{
    private $ruta;
    public function __construct()
    {
        $this->ruta          = "modulos/ws";
    }

    public function ret_arba($entrada)
    {
        //   die(var_dump($entrada));

        $cuit = $entrada['cuit']; //'30503940767';
        $fechadesde = $entrada['fecha_desde']; //'20211201';
        $fechahasta = $entrada['fecha_hasta']; //'20211231';

        $xml_base = '<?xml version = "1.0" encoding = "ISO-8859-1"?>
                    <CONSULTA-ALICUOTA>
                        <fechaDesde>' . $fechadesde . '</fechaDesde>
                        <fechaHasta>' . $fechahasta . '</fechaHasta>
                        <cantidadContribuyentes>1</cantidadContribuyentes>
                        <contribuyentes class="list">
                            <contribuyente>
                            <cuitContribuyente>' . $cuit . '</cuitContribuyente>
                            </contribuyente>
                        </contribuyentes>
                    </CONSULTA-ALICUOTA>';
        $fileName = "DFEServicioConsulta_" . md5($xml_base) . ".xml";
        $tmpDir = HOMEDIR . '/tmp/';

        $fp = fopen($tmpDir . $fileName, "wb");
        fwrite($fp, $xml_base);
        fclose($fp);

        $cURL = curl_init();
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        curl_setopt_array($cURL, $options);
        curl_setopt($cURL, CURLOPT_URL, "https://dfe.arba.gov.ar/DomicilioElectronico/SeguridadCliente/dfeServicioConsulta.do");
        curl_setopt($cURL, CURLOPT_POST, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($cURL, CURLOPT_POSTFIELDS, [
            "user" =>  $entrada['cuitemp'], //"30714048933",
            "password" =>  $entrada['pemp'],// "Evamoni615",
            "file" => curl_file_create($tmpDir . $fileName)
        ]);

        $response = curl_exec($cURL);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($cURL);
        }

        // Cerrar recurso
        curl_close($cURL);

        $xmlObject = simplexml_load_string($response);
        //Encode the SimpleXMLElement object into a JSON string.
        $jsonString = json_encode($xmlObject, JSON_PRETTY_PRINT);
       // die($jsonString);
        $object = json_decode($jsonString);
        $respuesta = 'alicuotaPercepcion:' . $object->contribuyentes->contribuyente->alicuotaPercepcion .'~';
        $respuesta =  $respuesta . 'alicuotaRetencion:' . $object->contribuyentes->contribuyente->alicuotaRetencion . '~';
        $respuesta =  $respuesta . 'grupoPercepcion:' . $object->contribuyentes->contribuyente->grupoPercepcion . '~';
        $respuesta =  $respuesta . 'grupoRetencion:' . $object->contribuyentes->contribuyente->grupoRetencion . '~';

        //die($object->contribuyentes->contribuyente->alicuotaRetencion);

        die($respuesta);
        //echo($json);
      //  die($response);

    }

    public function __destruct()
    {
    }
}
