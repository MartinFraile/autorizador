<?php
//if (!isset($_SESSION['LOGIN'])) {
//    session_start();
//}
require_once __DIR__ . "/../../config.php";

include __DIR__ . '/../../vendor/autoload.php';
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";

class actomed
{
    private $homedir;
    // propiedades de la clase
    private $tabla;
    private $campos_lst;
    private $campo_codigo;
    private $ruta;
    private $cantregistros;
    private $tipolist;

    public function __construct()
    {
        $this->homedir = HOMEDIR;
        require_once CLASES_LOCAL . "/personal.php";
        $personal = new personal();
        // $personal->islogin();    
        $this->ruta          = "modulos/ws";
    }





    public function get_api_img($entrada)
    {
        $url = "https://www.actomedico.com.ar/api/historias?" . http_build_query($entrada);
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

        $client      = curl_init($url);
        curl_setopt_array($client, $options);
        $response = curl_exec($client);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($client);
        }

        // Cerrar recurso
        curl_close($client);
        die($response);
    }

    public function afil_iapos($entrada)
    {
        
        $nroAfil = $entrada['nro_afil'];
        $fecpro = gmdate("Y-m-d");

        $wsdl = "https://aswe.santafe.gov.ar/iapos-sw-srvt/servlet/abewsvalidaafi?wsdl";
        $client = new nusoap_client($wsdl, TRUE);
        $client->setEndpoint($wsdl);

        $params = array('Usuario' => 'actomedico', 'Passwd' => '1234', 'Nafiliado' => $nroAfil, 'Badocnumdo' => '?', 'Tidocodigo_de_documento' => '0', 'Ogorcodigo' => '?', 'Fechpresta' => $fecpro);
        //die(var_dump($params));
        $result = $client->call('Execute', $params);
        if ($result== false) {            
            $result= array("nro_afil" =>  $nroAfil );
        }
        die(json_encode($this->utf8ize($result)));
    }

    public function utf8ize($d)
    {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->utf8ize($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    public function __destruct()
    {
    }



}





