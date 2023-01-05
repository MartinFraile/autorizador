<?php
if (!isset($_SESSION['LOGIN'])) {
    session_start();
}
require_once __DIR__ . "/../../config.php";
include HOMEDIR. '/vendor/autoload.php';
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";

class osceara
{
    private $ruta;
    public function __construct()
    {
        $this->ruta          = "modulos/ws/afiliado";
    }

    public function afil_osceara($entrada)
    {
        //  die(var_dump($entrada));
        $fecha = gmdate("YmdHis");
        $fechaRdmNum = $fecha . mt_rand(10000000, 99999999);
        $cuilPrestador = $entrada['cuil_prestador'];
        $cleanCuilPrestador = str_replace("-", "", $cuilPrestador);
        $RSoclPrestador = $this->get_prestador($cleanCuilPrestador);      
        $nroAfil = $entrada['nro_afil'];
        $tipodocumento = "0";
        $nrodocumento = "0";
        $financiador = 'OSCEARA ROSARIO';

        $xml_base = '<HL7><MSH><MSH.1/><MSH.2/><MSH.3>ITMEDM</MSH.3><MSH.4>ITM00000001</MSH.4><MSH.5><MSH.5.1>OSCEARA ROSARIO</MSH.5.1><MSH.5.2>000001</MSH.5.2><MSH.5.3>IIN</MSH.5.3></MSH.5><MSH.6>20210817111023</MSH.6><MSH.7/><MSH.8><MSH.8.1>ZQI</MSH.8.1><MSH.8.2>Z01</MSH.8.2><MSH.8.3>ZQI_Z01</MSH.8.3></MSH.8><MSH.9>21081711102352147610</MSH.9><MSH.10/><MSH.11/><MSH.12/><MSH.13/><MSH.14>NE</MSH.14><MSH.15>AL</MSH.15><MSH.16>ARG</MSH.16></MSH><PRD><PRD.1><PRD.1.1>PC</PRD.1.1><PRD.1.2>CENTRO MEDICO DEL SOL</PRD.1.2><PRD.1.3>00-00000000-0</PRD.1.3></PRD.1><PRD.2/><PRD.3/><PRD.4/><PRD.5/><PRD.6/><PRD.7><PRD.7.1>00-00000000-0</PRD.7.1><PRD.7.2>CU</PRD.7.2></PRD.7></PRD><PID><PID.1/><PID.2/><PID.3><PID.3.1></PID.3.1><PID.3.2>12</PID.3.2><PID.3.3>30474443</PID.3.3><PID.3.4>OSCEARA ROSARIO</PID.3.4><PID.3.5>HC</PID.3.5></PID.3><PID.4/><PID.5>UNKNOWN</PID.5></PID></HL7>';
        //Convert the XML string into an SimpleXMLElement object.
        $xmlObject = simplexml_load_string($xml_base);
        //Encode the SimpleXMLElement object into a JSON string.
        $jsonString = json_encode($xmlObject);
       
        //Convert it back into an associative array for
        //the purposes of testing.
        $jsonArray = json_decode($jsonString, true);
        $jsonArray['MSH']['MSH.6'] = $fecha;
        $jsonArray['MSH']['MSH.9'] = $fechaRdmNum;
        $jsonArray['PRD']['PRD.1']['PRD.1.2'] = $RSoclPrestador;
        $jsonArray['PRD']['PRD.1']['PRD.1.3'] = $cuilPrestador;
        $jsonArray['PRD']['PRD.7']['PRD.7.1'] = $cleanCuilPrestador;
        $jsonArray['PID']['PID.3']['PID.3.1'] = $nroAfil;
        $jsonArray['PID']['PID.3']['PID.3.2'] = $tipodocumento;
        $jsonArray['PID']['PID.3']['PID.3.3'] = $nrodocumento;
        $jsonArray['PID']['PID.3']['PID.3.4'] = $financiador;

        $xml = new SimpleXMLElement('<HL7/>');
        arrayToXml($jsonArray, $xml);

        $xmlPar = $xml->asXML();

        //die($xmlPar);


     //   $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador_prueba/Index.asmx?wsdl";
        $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador/Index.asmx?wsdl";
        $client = new nusoap_client($wsdl, TRUE);


        $result = $client->call('Procesar_StringXML_HL7_XML', array('cadenaXML' => $xmlPar));
        // Check for a fault
        if ($client->fault) {

            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo  $err;
            } else {


                $respuesta['estadomensaje'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.1'];
                $respuesta['codseg'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.2'];
                $respuesta['codseg1'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSH']['MSH.9'];
                $respuesta['nrosolicgen'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']['ZAU.2'];
                $respuesta['estado'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']['ZAU.3']['ZAU.3.1'];
                $respuesta['desc_estado'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']['ZAU.3']['ZAU.3.2'];
                //$respuesta['apellido'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['PID']['PID.5']['PID.5.1'];
                //$respuesta['nombre'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['PID']['PID.5']['PID.5.2'];    
                $respuesta['apeynom'] = utf8_decode($result['Procesar_StringXML_HL7_XMLResult']['HL7']['NTE'][0]['NTE.3']);
                $respuesta['apeynom'] = str_replace("Apellido y Nombre: ", "", $respuesta['apeynom']);
                $respuesta['plan'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['IN1']['IN1.2'];
                $respuesta['nro_documento'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['NTE'][3]['NTE.3'];
                $respuesta['nro_documento'] = str_replace("Nro. Documento: ", "", $respuesta['nro_documento']);

                //   print_r($result['Procesar_StringXML_HL7_XMLResult']);

                die(json_encode($respuesta));
            }
        }
    }

    public function cargasol_osceara($entrada)
    {
        //  die(var_dump($entrada));
       // $datos = json_decode($entrada['datos']);

        $fecha = gmdate("YmdHis");
        $fechaRdmNum = $fecha . mt_rand(10000000, 99999999);
        $sitiorecep = 'OSCEARA ROSARIO';
        $fechapres = $entrada['fecha_pres']; //'20100601';
        $cuilPrestador = $entrada['cuil_prestador'];
        $obsersol = 'Observaciones';
        $matriprofe = $entrada['matri_prof']; //'14509';
        $codprovprofe = 'S';
        $tipoprofpres = $entrada['tipo_prof']; //'2';
        $apeprofe = $entrada['apeyom_prof']; //'SANCHEZ';
        $nomprofe = '';
        $cleanCuilPrestador = str_replace("-", "", $cuilPrestador);
        $RSoclPrestador = $this->get_prestador($cleanCuilPrestador);   
        $nroAfil = $entrada['nro_afil'];
        $tipodocumento = "0";
        $nrodocumento = "0";
        $financiador = 'OSCEARA ROSARIO';
        $nrodetalle = '1';
        $codnomencla = '600001';
        $desprestacion = 'PROTESIS';
        $fechaprestacion = '20100601';
        $cantpracsol = '1';
        
        $prdet = $entrada['det_practicas']; //'<PR1><PR1.1>1</PR1.1><PR1.2/><PR1.3><PR1.3.1>600001</PR1.3.1><PR1.3.2>PROTESIS</PR1.3.2><PR1.3.3>1</PR1.3.3><PR1.3.4/></PR1.3><PR1.4/><PR1.5>20100601</PR1.5></PR1><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4/><AUT.5/><AUT.6/><AUT.7/><AUT.8>1</AUT.8></AUT><PR1><PR1.1>1</PR1.1><PR1.2/><PR1.3><PR1.3.1>250101</PR1.3.1><PR1.3.2>AGENTES FISICOS, FISIOTERAPIA, HORNO DE BIER, RAYOS, INFRARROJOS, HIDROTERAPIA, PARAFINA, FOMENTACIONES, CRIOTERAPIA, RAYOS ULTRAVIOLETAS.</PR1.3.2><PR1.3.3>1</PR1.3.3><PR1.3.4/></PR1.3><PR1.4/><PR1.5>20100601</PR1.5></PR1><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4/><AUT.5/><AUT.6/><AUT.7/><AUT.8>1</AUT.8></AUT>';
        //  $prdet = '<PR1><PR1.1>1</PR1.1><PR1.2/><PR1.3><PR1.3.1>600001</PR1.3.1><PR1.3.2>PROTESIS</PR1.3.2><PR1.3.3>1</PR1.3.3><PR1.3.4/></PR1.3><PR1.4/><PR1.5>20100601</PR1.5></PR1><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4/><AUT.5/><AUT.6/><AUT.7/><AUT.8>1</AUT.8></AUT>';


        //$xml_base = '<HL7><MSH><MSH.1/><MSH.2/><MSH.3>ITMEDM</MSH.3><MSH.4>ITM00000001</MSH.4><MSH.5><MSH.5.1>OSCEARAROSARIO</MSH.5.1><MSH.5.2>000001</MSH.5.2><MSH.5.3>IIN</MSH.5.3></MSH.5><MSH.6>20210611113307</MSH.6><MSH.7/><MSH.8><MSH.8.1>ZQA</MSH.8.1><MSH.8.2>Z02</MSH.8.2><MSH.8.3>ZQA_Z02</MSH.8.3></MSH.8><MSH.9>21061111330727571494</MSH.9><MSH.10/><MSH.11/><MSH.12/><MSH.13/><MSH.14>NE</MSH.14><MSH.15>AL</MSH.15><MSH.16>ARG</MSH.16></MSH><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4>20200605</AUT.4></AUT><PRD><PRD.1><PRD.1.1>PC</PRD.1.1><PRD.1.2>CENTROMEDICODELSOL</PRD.1.2></PRD.1><PRD.2/><PRD.3><PRD.3.1>9518</PRD.3.1><PRD.3.2>S</PRD.3.2><PRD.3.3>2</PRD.3.3><PRD.3.4>FAUSTABEL</PRD.3.4><PRD.3.5/></PRD.3><PRD.4/><PRD.5/><PRD.6/><PRD.7><PRD.7.1>00000000000</PRD.7.1><PRD.7.2>CU</PRD.7.2></PRD.7></PRD><PID><PID.1/><PID.2/><PID.3><PID.3.1>30474443/00</PID.3.1><PID.3.2>12</PID.3.2><PID.3.3>30474443</PID.3.3><PID.3.4>OSCEARAROSARIO</PID.3.4><PID.3.5>HC</PID.3.5></PID.3><PID.4/><PID.5>UNKNOWN</PID.5></PID><PR1><PR1.1>1</PR1.1><PR1.2/><PR1.3><PR1.3.1>600001</PR1.3.1><PR1.3.2>PROTESIS</PR1.3.2><PR1.3.3>1</PR1.3.3><PR1.3.4/></PR1.3><PR1.4/><PR1.5>20210611</PR1.5></PR1><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4/><AUT.5/><AUT.6/><AUT.7/><AUT.8>1</AUT.8></AUT></HL7>';
  
        $xml_base = '<HL7><MSH><MSH.1/><MSH.2/><MSH.3>ITMEDM</MSH.3><MSH.4>ITM00000001</MSH.4><MSH.5><MSH.5.1>OSCEARAROSARIO</MSH.5.1><MSH.5.2>000001</MSH.5.2><MSH.5.3>IIN</MSH.5.3></MSH.5><MSH.6>20210611113307</MSH.6><MSH.7/><MSH.8><MSH.8.1>ZQA</MSH.8.1><MSH.8.2>Z02</MSH.8.2><MSH.8.3>ZQA_Z02</MSH.8.3></MSH.8><MSH.9>21061111330727571494</MSH.9><MSH.10/><MSH.11/><MSH.12/><MSH.13/><MSH.14>NE</MSH.14><MSH.15>AL</MSH.15><MSH.16>ARG</MSH.16></MSH><AUT><AUT.1/><AUT.2/><AUT.3/><AUT.4>20200605</AUT.4></AUT><PRD><PRD.1><PRD.1.1>PC</PRD.1.1><PRD.1.2>CENTROMEDICODELSOL</PRD.1.2></PRD.1><PRD.2/><PRD.3><PRD.3.1>9518</PRD.3.1><PRD.3.2>S</PRD.3.2><PRD.3.3>2</PRD.3.3><PRD.3.4>FAUSTABEL</PRD.3.4><PRD.3.5/></PRD.3><PRD.4/><PRD.5/><PRD.6/><PRD.7><PRD.7.1>00000000000</PRD.7.1><PRD.7.2>CU</PRD.7.2></PRD.7></PRD><PID><PID.1/><PID.2/><PID.3><PID.3.1>30474443/00</PID.3.1><PID.3.2>12</PID.3.2><PID.3.3>30474443</PID.3.3><PID.3.4>OSCEARAROSARIO</PID.3.4><PID.3.5>HC</PID.3.5></PID.3><PID.4/><PID.5>UNKNOWN</PID.5></PID>' . $prdet . '</HL7>';
        //Convert the XML string into an SimpleXMLElement object.
        $xmlObject = simplexml_load_string($xml_base);

        $xmlObject->MSH->{"MSH.5"}->{"MSH.5.1"} = $sitiorecep;
        $xmlObject->MSH->{"MSH.6"} = $fecha;
        $xmlObject->MSH->{"MSH.9"} = $fechaRdmNum;
        $xmlObject->AUT->{"AUT.4"} = $fechapres;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.2"} = $RSoclPrestador;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.3"} = $cuilPrestador;
        $xmlObject->PRD->{"PRD.2"} = $obsersol;
        $xmlObject->PRD->{"PRD.3"}->{"PRD.3.1"} = $matriprofe;
        $xmlObject->PRD->{"PRD.3"}->{"PRD.3.2"} = $codprovprofe;
        $xmlObject->PRD->{"PRD.3"}->{"PRD.3.3"} = $tipoprofpres;
        $xmlObject->PRD->{"PRD.3"}->{"PRD.3.4"} = $apeprofe;
        $xmlObject->PRD->{"PRD.3"}->{"PRD.3.5"} = $nomprofe;
        $xmlObject->PRD->{"PRD.7"}->{"PRD.7.1"} = $cleanCuilPrestador;
        $xmlObject->PID->{"PID.3"}->{"PID.3.1"} = $nroAfil;
        $xmlObject->PID->{"PID.3"}->{"PID.3.2"} = $tipodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.3"} = $nrodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.4"} = $financiador;
        $xmlPar = $xmlObject->asXML();
        

        //   $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador_prueba/Index.asmx?wsdl";
        $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador/Index.asmx?wsdl";

        $client = new nusoap_client($wsdl, TRUE);


        $result = $client->call('Procesar_StringXML_HL7_XML', array('cadenaXML' => $xmlPar));
        // Check for a fault
        if ($client->fault) {

            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo  $err;
            } else {
             
                $respuesta['estadomensaje'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.1'];
                $respuesta['codseg'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.2'];
				$respuesta['apeynom'] = utf8_encode($result['Procesar_StringXML_HL7_XMLResult']['HL7']['NTE'][0]['NTE.3']);
                $respuesta['apeynom'] = str_replace("Apellido y Nombre: ", "", $respuesta['apeynom']);
                $respuesta['plan'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['IN1']['IN1.2'];
                $respuesta['nro_documento'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['NTE'][3]['NTE.3'];
                $respuesta['nro_documento'] = str_replace("Nro. Documento:", "", $respuesta['nro_documento']);
                $respuesta['nro_afiliado'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['NTE'][4]['NTE.3'];
                $respuesta['nro_afiliado'] = str_replace("Nro. Afiliado:", "", $respuesta['nro_afiliado']);

                //$respuesta['detalle'] = utf8_encode($result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']);

                foreach ($result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU'] as  $row) {
                    // print_r(var_dump($detalle));
                    $detalle['nroop'] = $row['ZAU.2'];
                    $detalle['coseguro'] = $row['ZAU.6'];
                    $detalle['codestado'] = $row['ZAU.3']['ZAU.3.1'];
                    $detalle['desestado'] = utf8_encode($row['ZAU.3']['ZAU.3.2']);
                    $detalleArr[] = $detalle;
                }
                $respuesta['detalle'] = $detalleArr;

                die(json_encode($respuesta));
            }
        }
    }

    public function consultasol_osceara($entrada)
    {
        //  die(var_dump($entrada));


        $fecha = gmdate("YmdHis");
        $fechaRdmNum = $fecha . mt_rand(10000000, 99999999);
        $sitiorecep = 'OSCEARA ROSARIO';
        $cuilPrestador = $entrada['cuil_prestador'];
        $cleanCuilPrestador = str_replace("-", "", $cuilPrestador);
        $RSoclPrestador = $this->get_prestador($cleanCuilPrestador);   
        $nroAfil = $entrada['nro_afil'];
        $tipodocumento = "0";
        $nrodocumento = "0";
        $financiador = 'OSCEARA ROSARIO';
        $nrosol = $entrada['nro_sol'];



        $xml_base = '<HL7><MSH><MSH.1/><MSH.2/><MSH.3>ITMEDM</MSH.3><MSH.4>ITM00000001</MSH.4><MSH.5><MSH.5.1>NOBIS</MSH.5.1><MSH.5.2>000001</MSH.5.2><MSH.5.3>IIN</MSH.5.3></MSH.5><MSH.6>20100701115819</MSH.6><MSH.7/><MSH.8><MSH.8.1>ZQA</MSH.8.1><MSH.8.2>Z04</MSH.8.2><MSH.8.3>ZQA_Z06</MSH.8.3></MSH.8><MSH.9>19010111575952706005</MSH.9><MSH.10/><MSH.11/><MSH.12/><MSH.13/><MSH.14>NE</MSH.14><MSH.15>AL</MSH.15><MSH.16>ARG</MSH.16></MSH><ZAU><ZAU.1/><ZAU.2>386250</ZAU.2></ZAU><PRD><PRD.1><PRD.1.1>PC</PRD.1.1><PRD.1.2>Salta</PRD.1.2><PRD.1.3>30543366761</PRD.1.3></PRD.1><PRD.2/><PRD.3/><PRD.4/><PRD.5/><PRD.6/><PRD.7><PRD.7.1>30543366761</PRD.7.1><PRD.7.2>CU</PRD.7.2></PRD.7></PRD><PID><PID.1/><PID.2/><PID.3><PID.3.1>12996133</PID.3.1><PID.3.2/><PID.3.3/><PID.3.4>NOBIS</PID.3.4><PID.3.5>HC</PID.3.5></PID.3><PID.4/><PID.5>UNKNOWN</PID.5></PID></HL7>';
        //Convert the XML string into an SimpleXMLElement object.

        //  die(print_r($xml_base));
        $xmlObject = simplexml_load_string($xml_base);

        $xmlObject->MSH->{"MSH.5"}->{"MSH.5.1"} = $sitiorecep;
        $xmlObject->MSH->{"MSH.6"} = $fecha;
        $xmlObject->MSH->{"MSH.9"} = $fechaRdmNum;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.2"} = $RSoclPrestador;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.3"} = $cuilPrestador;
        $xmlObject->PRD->{"PRD.7"}->{"PRD.7.1"} = $cleanCuilPrestador;
        $xmlObject->PID->{"PID.3"}->{"PID.3.1"} = $nroAfil;
        $xmlObject->PID->{"PID.3"}->{"PID.3.2"} = $tipodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.3"} = $nrodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.4"} = $financiador;
        $xmlObject->ZAU->{"ZAU.2"} = $nrosol;
        $xmlPar = $xmlObject->asXML();


     
        //   $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador_prueba/Index.asmx?wsdl";
        $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador/Index.asmx?wsdl";

        $client = new nusoap_client($wsdl, TRUE);


        $result = $client->call('Procesar_StringXML_HL7_XML', array('cadenaXML' => $xmlPar));
        // Check for a fault
        if ($client->fault) {

            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo  $err;
            } else {
//die(json_encode($result));
                $respuesta['estadomensaje'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.1'];
                $respuesta['codseg'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.2'];


                foreach ($result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU'] as  $row) {
                   
                    $detalle['nroop'] = isset($row['ZAU.2'])? $row['ZAU.2']: $nrosol;                    
                    $detalle['codestado'] =  isset($row['ZAU.3']['ZAU.3.1'])? $row['ZAU.3']['ZAU.3.1']: 'Solicitud no encontrada';
                    $detalle['desestado'] =   isset($row['ZAU.3']['ZAU.3.2'])? utf8_encode($row['ZAU.3']['ZAU.3.2']): 'Solicitud no encontrada';
                    $detalleArr[] = $detalle;
                }
                $respuesta['detalle'] = $detalleArr;

                die(json_encode($respuesta));
            }
        }
    }

    public function anulasol_osceara($entrada)
    {
        //  die(var_dump($entrada));


        $fecha = gmdate("YmdHis");
        $fechaRdmNum = $fecha . mt_rand(10000000, 99999999);
        $sitiorecep = 'OSCEARA ROSARIO';
        $cuilPrestador = $entrada['cuil_prestador'];
        $cleanCuilPrestador = str_replace("-", "", $cuilPrestador);
        $RSoclPrestador = $this->get_prestador($cleanCuilPrestador);   
        $nroAfil = $entrada['nro_afil'];
        $tipodocumento = "0";
        $nrodocumento = "0";
        $financiador = 'OSCEARA ROSARIO';
        $nrosol = $entrada['nro_sol'];



        $xml_base = '<HL7><MSH><MSH.1/><MSH.2/><MSH.3>ITMEDM</MSH.3><MSH.4>ITM00000001</MSH.4><MSH.5><MSH.5.1>Obra Social</MSH.5.1><MSH.5.2>000001</MSH.5.2><MSH.5.3>IIN</MSH.5.3></MSH.5><MSH.6>20100701115819</MSH.6><MSH.7/><MSH.8><MSH.8.1>ZQA</MSH.8.1><MSH.8.2>Z04</MSH.8.2><MSH.8.3>ZQA_Z02</MSH.8.3></MSH.8><MSH.9>19010111575952706005</MSH.9><MSH.10/><MSH.11/><MSH.12/><MSH.13/><MSH.14>NE</MSH.14><MSH.15>AL</MSH.15><MSH.16>ARG</MSH.16></MSH><ZAU><ZAU.1/><ZAU.2>386250</ZAU.2></ZAU><PRD><PRD.1><PRD.1.1>PC</PRD.1.1><PRD.1.2>Razón Social Prestador</PRD.1.2><PRD.1.3>CUIT con guiones</PRD.1.3></PRD.1><PRD.2/><PRD.3/><PRD.4/><PRD.5/><PRD.6/><PRD.7><PRD.7.1>CUIT Prestador sin guiones</PRD.7.1><PRD.7.2>CU</PRD.7.2></PRD.7></PRD><PID><PID.1/><PID.2/><PID.3><PID.3.1>12996133</PID.3.1><PID.3.2/><PID.3.3/><PID.3.4>Obra Social</PID.3.4><PID.3.5>HC</PID.3.5></PID.3><PID.4/><PID.5>UNKNOWN</PID.5></PID></HL7>';
        //Convert the XML string into an SimpleXMLElement object.

       //  die(print_r($xml_base));
        $xmlObject = simplexml_load_string($xml_base);

        $xmlObject->MSH->{"MSH.5"}->{"MSH.5.1"} = $sitiorecep;
        $xmlObject->MSH->{"MSH.6"} = $fecha;
        $xmlObject->MSH->{"MSH.9"} = $fechaRdmNum;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.2"} = $RSoclPrestador;
        $xmlObject->PRD->{"PRD.1"}->{"PRD.1.3"} = $cuilPrestador;
        $xmlObject->PRD->{"PRD.7"}->{"PRD.7.1"} = $cleanCuilPrestador;
        $xmlObject->PID->{"PID.3"}->{"PID.3.1"} = $nroAfil;
        $xmlObject->PID->{"PID.3"}->{"PID.3.2"} = $tipodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.3"} = $nrodocumento;
        $xmlObject->PID->{"PID.3"}->{"PID.3.4"} = $financiador;
        $xmlObject->ZAU->{"ZAU.2"} = $nrosol;
        $xmlPar = $xmlObject->asXML();
        //die($xmlPar);

         //   $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador_prueba/Index.asmx?wsdl";
        $wsdl = "http://www.micamsalud.com.ar:8080/webserviceautorizador/Index.asmx?wsdl";
 
        $client = new nusoap_client($wsdl, TRUE);


        $result = $client->call('Procesar_StringXML_HL7_XML', array('cadenaXML' => $xmlPar));
        // Check for a fault
        if ($client->fault) {

            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo  $err;
            } else {


                $respuesta['estadomensaje'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.1'];
                $respuesta['codseg'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['MSA']['MSA.2'];
                $respuesta['codestado'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']['ZAU.1'];
                $respuesta['desestado'] = $result['Procesar_StringXML_HL7_XMLResult']['HL7']['ZAU']['ZAU.2'];

//die(json_encode($result));
//print_r($result['Procesar_StringXML_HL7_XMLResult']);

                die(json_encode($respuesta));
            }
        }
    }


    public function get_prestador($nro_cuit)
    {

        $jsonitem = file_get_contents("prestadores.json");

        $objitems = json_decode($jsonitem);


        $findByCuit = function ($cuit) use ($objitems) {
            foreach ($objitems as $prestadores) {
                if ($prestadores->Nro_Documento == $cuit) return $prestadores->RSocialPres;
            }

            return false;
        };

       return $findByCuit($nro_cuit) ?: 'No record found.';
      

    }
    public function __destruct()
    {
    }
}