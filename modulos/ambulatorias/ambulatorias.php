<?php

session_start();
require_once "../../config.php";

include '../../vendor/autoload.php';
require_once CLASES_LOCAL . "/funciones.php";
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/setup_smarty.php";
use JasperPHP\JasperPHP;

class ambulatorias
{
    private $homedir;
    // propiedades de la clase
    private $tabla;
    private $campos_lst;
    private $campo_codigo;
    private $ruta;
    private $cantregistros;
    private $tipolist;
    private $smarty;

    public function __construct()
    {
        $this->homedir = HOMEDIR;
        require_once CLASES_LOCAL . "/personal.php";
        $personal = new personal();
        $personal->islogin();
        $this->tabla         = 'whal.olbenef';
        $this->campo_codigo  = "nro_documento";
        $this->codigo        = leerentrada($this->campo_codigo);
        $this->ruta          = "ambulatorias";		
        $this->cantregistros = 15;

        $this->campos_lst = array(
            'nroafil'  => array(
                'alias'     => 'Nro Afil',
                'nom_campo' => 'nroafil',
            ),
            'apeynom'  => array(
                'alias'     => 'Ape y Nom',
                'nom_campo' => 'apeynom',
            ),
            'codprac'  => array(
                'alias'     => 'Cod Prac',
                'nom_campo' => 'codprac',
            ),
            'despres'  => array(
                'alias'     => 'Practica',
                'nom_campo' => 'despres',
            ),
            'desobsoc' => array(
                'alias'     => 'Ob Soc',
                'nom_campo' => 'desobsoc',
            ),

        );
        $this->smarty          = new Smarty_Whal();
        $this->smarty->caching = false;
		$this->smarty->assign('active', "Home");
       
    }

    public function grid($entrada)
    {

        $matricula = $_SESSION['nroafil'];
        $cuitpres = $_SESSION['nro_documento'];
        $today     = (isset($entrada['fecha'])) ? $entrada['fecha'] : date('Y-m-d');
        //$today = date('Y-m-d');
        $sql = " exec whal.prd_ctrlcargadiaOdon  '" . $today . "', " . $cuitpres . " , '' ";
        
        require_once CLASES_LOCAL . "/funciones_list.php";
        $datagrid = new funciones_list();
        foreach ($this->campos_lst as $nomfisico => $campo) {
            $datagrid->nueva_columna($campo['nom_campo'], $campo['alias'], $campo);
        }

        if ($_SESSION['clase_opera'] == 'Asociaciones') {
            $listmed['medico'] = array(
                'alias'     => 'Efector',
                'nom_campo' => 'medico',
            );
            $datagrid->nueva_columna($listmed['medico']['nom_campo'], $listmed['medico']['alias'], $listmed);
        }
        $datagrid->mostrar($sql, $this->smarty);
        $this->smarty->assign('hidebus', 'true');
        // $smarty->assign('titulo', 'ambodont del dia');
        $this->smarty->display(HOMEDIR . '/tpl/listado.tpl');

    }


     public function list_estado($entrada)
    {
        $cod_obsocConec = (isset($entrada['cod_obsoc'])) ? $entrada['cod_obsoc'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;

        $error                 = DB::Connect();

        if ($error) {
            die('Error en conexión');
        }


        $matricula = 0;
        $cuitpres = $_SESSION['nro_documento'];
        $inst = DB::SelectValue('whal.busmedodont','minstituciones_id',"cuitpres='" . $cuitpres . "'");
        
        switch ($entrada['estado']) {
            case "Pendientes":
                $estado = "P";
                break;
            case "Aprobadas":
                $estado = "A";
                break;
            case "PedidoInforme":
                $estado = "I";
                break;
            case "Rechazadas":
                $estado = "R";
                break;
        }
        $des = strtotime($entrada['fecdesde']);
        $fecdesde = date("d/m/Y", $des); 
        $has = strtotime($entrada['fechasta']);           
        $fechasta = date("d/m/Y", $has); 
        $sql = " exec whal.OL_OdAuditadas " . $inst . " ," . $matricula . " , '" . $estado."', '','" . $fecdesde."','" . $fechasta."'";
        
         $this->campos_lst = array(
            'fecha_autoriza'  => array(
                'alias'     => 'Fecha',
                'nom_campo' => 'fecha_autoriza',
            ),
            'nro_documento'  => array(
                'alias'     => 'Nro Doc',
                'nom_campo' => 'nro_documento',
            ),
            'nro_orden'  => array(
                'alias'     => 'Nro orden',
                'nom_campo' => 'nro_orden',
            ),
            'cosegtot'  => array(
                'alias'     => 'Coseguro',
                'nom_campo' => 'cosegtot',
            ),
            'imptot' => array(
                'alias'     => 'Importe',
                'nom_campo' => 'imptot',
            ),
            'odontologo' => array(
                'alias'     => 'Odontologo',
                'nom_campo' => 'odontologo',
            ),
            'mensaje' => array(
                'alias'     => 'Mensaje',
                'nom_campo' => 'mensaje',
            ),

        );
        
   
        require_once CLASES_LOCAL . "/funciones_list.php";
        $datagrid = new funciones_list();
        foreach ($this->campos_lst as $nomfisico => $campo) {
            $datagrid->nueva_columna($campo['nom_campo'], $campo['alias'], $campo);
        }

        if ($entrada['estado'] != "Pendientes" && $entrada['estado'] != "PedidoInforme" ) {
            $datagrid->nueva_columna('listado', 'imprimir', array('clase' => 'listadosgrilla', 'funcion' => 'pImp', 'campos' => $this->campos_lst, 'class' => 'text-center', 'div' => 'div_principal', 'script' => 'imprimeOrden'));
        }
        if ($entrada['estado'] == "PedidoInforme") {
            $datagrid->nueva_columna('listado', 'Adjunta', array('clase' => 'listadosgrilla', 'funcion' => 'pModificar', 'campos' => $this->campos_lst, 'class' => 'text-center', 'div' => 'div_principal', 'script' => 'adjuntaInforme'));
        }

        $datagrid->mostrar($sql, $this->smarty);
        $this->smarty->assign('hidebus', true);  
        $_SESSION['cod_obsoc'] = $obsocSess ;      
        $this->smarty->display(HOMEDIR . '/tpl/listado.tpl');

    }

    public function form_list_estado($entrada)
    {
        $estado = $entrada['estado'];

        $where = 'not exists ( select * from  TOpObSocNO where operadores_ID = '.$_SESSION['operadores_id'].' AND CodObSoc = qs.codigo)';
        $this->smarty->assign('titulo', 'Listado');        
        $this->smarty->assign('obrasoc', fnccomboDB("qryOSConecaut", "codigo", "descripcion", "codigo",$where));
        
        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->assign('estado', $estado);
        $this->smarty->display('form_list_estado.tpl');

    }

    public function modificar($entrada)
    {
        
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };
 
       
        if (leerentrada('accion') == 'guardar') {            
            $this->save($entrada);            
            $_POST['accion']   = '';
            $entrada['accion'] = '';
            echo "loading('hide');";
            echo "javascript: link_ajax('/base/" . $this->ruta . "/modificar.php','div_principal');";
            echo 'setTimeout(function(){ msgsnackbar("Grabó correctamente", "success"); }, 1000)';
        } else {
            
            $efector = $this->smarty->fetch('efector.tpl');
            $this->smarty->assign('efector', $efector);

            $prescriptor = $this->smarty->fetch('prescriptor.tpl');
            $this->smarty->assign('prescriptor', $prescriptor);

            $diagno = $this->smarty->fetch('diagno.tpl');
            $this->smarty->assign('diagno', $diagno);

            $this->smarty->assign('titulo', 'Solicitud Autorizacion de Practicas Ambulatorias');
            $this->smarty->assign('ruta', $this->ruta);
            $where = ' not exists ( select * from  TOpObSocNO where operadores_ID = '.$_SESSION['operadores_id'].' AND CodObSoc = qryOSConecaut.codigo)';              
            $this->smarty->assign('obsoc', fnccomboDBConect("qryOSConecaut", "codigo", "descripcion", "cod_tosconec",$where));            
            $this->smarty->display('formulario.tpl');
    }
}
    public function adjuntaInforme($entrada)
        {
            if (isset($entrada['param'])) {
                $entrada = base64_decode($entrada['param']);
                parse_str($entrada, $entrada);
            };
            $cod_obsocConec = (isset($entrada['codinterno'])) ? $entrada['codinterno'] :  $_SESSION['cod_obsoc'];     
            $obsocSess = $_SESSION['cod_obsoc'];
            $_SESSION['cod_obsoc'] = $cod_obsocConec ;
            $mensaje = $entrada['mensaje'];          
            $this->smarty->assign('titulo', 'Adjunta Informe pedido Auditor');
            $this->smarty->assign('ruta', $this->ruta);
            $this->smarty->assign('cod_obsoc',$cod_obsocConec);  
            $_SESSION['cod_obsoc'] = $obsocSess ;  
            $this->smarty->assign('mensaje',$mensaje);      
            $this->smarty->display('adjuntainforme.tpl');
        
    }
    public function agrega_adjunto()
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };
        $cod_obsocConec = (isset($entrada['codinterno'])) ? $entrada['codinterno'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
                  
        $this->smarty->assign('titulo', 'Adjunta Informe pedido Auditor');
        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->assign('cod_obsoc',$cod_obsocConec);  
        $_SESSION['cod_obsoc'] = $obsocSess ;       
        $this->smarty->display('agrega_adjunto.tpl');
    
}
    public function consulta_aut($entrada)
        {
            if (isset($entrada['param'])) {
                $entrada = base64_decode($entrada['param']);
                parse_str($entrada, $entrada);
            };

       
        $cod_obsocConec = (isset($entrada['codinterno'])) ? $entrada['codinterno'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
       

        $error                 = DB::Connect();

        if ($error) {
            die('Error en conexión');
        }
            
        $sql    = 'exec whal.OLPractica '. $entrada['nro_orden'].', 0';   
         
        
        $datos = DB::Query($sql);

        $importe = $entrada['imptot'];
        $coseguro = $entrada['cosegtot'];
        $profesional = $datos[0]['apellidos'];
        $nro_orden = $datos[0]['nro_orden'];
        $afiliado = $datos[0]['apenom'];
        $desestado = $datos[0]['desestado'];
        $estado = $datos[0]['estado'];

        $this->smarty->assign('titulo', 'Autorizacion');
        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->assign('cod_obsoc',$cod_obsocConec);  
        $this->smarty->assign('desestado',$desestado);
        $this->smarty->assign('profesional',$profesional);
        $this->smarty->assign('nro_orden',$nro_orden);
        $this->smarty->assign('afiliado',$afiliado); 
        $this->smarty->assign('estado',$estado);
        $this->smarty->assign('imptot',$importe); 
        $this->smarty->assign('cosegtot',$coseguro);      
        $this->smarty->assign('datos',json_encode($datos)); 
        $_SESSION['cod_obsoc'] = $obsocSess ;            
        $this->smarty->display('consulta_aut.tpl');
        
    }

    public function anula_aut($entrada)
        {
            if (isset($entrada['param'])) {
                $entrada = base64_decode($entrada['param']);
                parse_str($entrada, $entrada);
            };
 
        $cod_obsocConec = (isset($entrada['codinterno'])) ? $entrada['codinterno'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
      
        $error                 = DB::Connect();

        if ($error) {
            die('Error en conexión');
        }
            
        $sql    = 'exec whal.OL_OdAnulaOrd '. $entrada['nro_orden'].'';   
        //$sql    = 'exec whal.OL_OdAnulaOrd 49898989';   
         
        
        $success = DB::Query($sql);
        
        echo '$("#myModal").remove();';
        if ($success) {            
            die('msgsnackbar("Anulo correctamente", "success");');
        }  else{            
            die('msgsnackbar("Error al anular", "warning");');
        } 
        
        
    }

    public function carga_inst($entrada)
    {
        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
            $obsocSess = $_SESSION['cod_obsoc'];
            $_SESSION['cod_obsoc'] = $cod_obsocConec ;

        $error                 = DB::Connect();

        if ($error) {
            die('Error en conexión');
        }
        $datosinst = DB::Select('whal.autoperadores','id_minstituciones,cod_agencia,operadores_id,matricula',"nroingreso='" . $_SESSION['nroingreso'] . "'");
       
        
        return json_encode($datosinst[0]);
           

    }
    public function form_list_aut($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
    
        
        $error = DB::Connect(); 
        if ($error) die($error); 


        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };
        

        if (leerentrada('accion') == 'imprimir') {
            // echo "javascript: link_ajax('/base/".$this->ruta."/modificar.php','div_principal');";

        } else {
            $this->smarty->assign('titulo', 'Listador de Autorizaciones');
            $this->smarty->assign('ruta', $this->ruta);
            //$this->smarty->assign('asociaciones', fnccomboDB("whal.ol_businst", "cod_prestador", "prestador", "cod_prestador",array("matricula" =>  intval($_SESSION['nroafil']))));
            $this->smarty->assign('obrasoc', fnccomboDB("whal.ol_obsocconodon", "cod_obsocconec", "desc_obsoc", "cod_obsocconec",array("nro_documento" =>  $_SESSION['nro_documento'])));            
            $_SESSION['cod_obsoc'] = $obsocSess ;            
            $this->smarty->display('form_list_aut.tpl');
        }
    }
    public function form_list_liq($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        if (leerentrada('accion') == 'imprimir') {
            // echo "javascript: link_ajax('/base/".$this->ruta."/modificar.php','div_principal');";

        } else {
            $this->smarty->assign('titulo', 'Listado de Liquidaciones');
            $this->smarty->assign('ruta', $this->ruta);
          //  $smarty->assign('obrasoc', fnccargacombo($bd, "whal.tobrasoc", "codigo", "descripcion", "codigo", "websn = 1 "));
            $this->smarty->assign('asociaciones', fnccomboDB("whal.ol_businst", "cod_prestador", "prestador", "cod_prestador",array("matricula" =>  intval($_SESSION['nroafil']))));
            $this->smarty->display('form_list_liq.tpl');
        }
    }

    public function list_buscar_aut($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        }

        //die(var_dump($entrada));
        $cod_obsocConec = (isset($entrada['cod_obsoc'])) ? $entrada['cod_obsoc'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;

        $error                 = DB::Connect();

        if ($error) {
            die('Error en conexión');
        }


        $matricula = 0;
        $cuitpres = $_SESSION['nro_documento'];
        $inst = DB::SelectValue('whal.busmedodont','minstituciones_id',"cuitpres='" . $cuitpres . "'");
        
        $obsoc      = 1;
        $periodo    = explode('-', $entrada['periodo']);

        $sql = " exec whal.OL_OdctrlCarga " . $periodo[0] . "," . $periodo[1] . "," . $obsoc . "," . $inst . ", ". $matricula .", 0, '' ";
        
        //die($sql);


         $this->campos_lst = array(
            'fecha_autoriza'  => array(
                'alias'     => 'Fecha',
                'nom_campo' => 'fecha_autoriza',
            ),
            'apeynom'  => array(
                'alias'     => 'Nombre',
                'nom_campo' => 'apeynom',
            ),
            'nro_documento'  => array(
                'alias'     => 'Nro Doc',
                'nom_campo' => 'nro_documento',
            ),
            'nro_orden'  => array(
                'alias'     => 'Nro orden',
                'nom_campo' => 'nro_orden',
            ),
            'odontologo' => array(
                'alias'     => 'Odontologo',
                'nom_campo' => 'odontologo',
            ),
            'estado' => array(
                'alias'     => 'Estado',
                'nom_campo' => 'estado',
            ),

        );
        
   
        require_once CLASES_LOCAL . "/funciones_list.php";
        $datagrid = new funciones_list();
        foreach ($this->campos_lst as $nomfisico => $campo) {
            $datagrid->nueva_columna($campo['nom_campo'], $campo['alias'], $campo);
        }

        $datagrid->nueva_columna('listado', 'Ver', array('clase' => 'listadosgrilla', 'funcion' => 'pModificarModal', 'campos' => $this->campos_lst, 'class' => 'text-center', 'div' => 'div_principal', 'script' => 'consulta_aut'));
   
        $datagrid->mostrar($sql, $this->smarty);
        $this->smarty->assign('hidebus', true);  
        $_SESSION['cod_obsoc'] = $obsocSess ;      
        $this->smarty->display(HOMEDIR . '/tpl/listado.tpl');
      
    }

     public function imprimir($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsoc'])) ? $entrada['cod_obsoc'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
            
        $error = DB::Connect(); 
        if ($error) die($error);
          
        $where = array('cuitpres' => $_SESSION['nro_documento']);
        $datos1 = DB::SelectRow('whal.busmedodont', '*', $where);
        
        $cod_prestador = $datos1['minstituciones_id'];

        if ($_SESSION['clase_opera'] == 'Odontologo') {  
            $cod_medpres = $datos1['matricula'];            
                   
        } else{
            $cod_medpres = 0;     
        }

        
        $reportName = 'jrCtrlCargaol';
        $input      = HOMEDIR . '/reportes/' . $reportName . '.jasper';
        $output     = HOMEDIR . '/tmp/ctr_carga_' . $_SESSION['nroafil'];
       
        $obsoc      = 1;
        $asociaciones = $cod_prestador;
        $periodo    = explode('-', $entrada['periodo']);
        $where      = " " . $periodo[0] . "," . $periodo[1] . "," . $obsoc . "," . $asociaciones . ", ". $cod_medpres .", 0, '' ";
        $corte      = $entrada['corte'];
        $desfiltro  = "Periodo: " . $entrada['periodo'] . " ";
        $urlimg     = HOMEDIR . '/img/logo_pdf_' . $_SESSION['cod_obsoc'] . '.jpg';
    
        $jdbc_dir = HOMEDIR . '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc';
        $pdfconec = json_decode(DesEncriptarCadena($_SESSION['pdfconec']));
        $options  = [
            'format'        => ['pdf'],
            'locale'        => 'es',
            'params'        => array("where" => $where, "urlimg" => $urlimg, "corte" => $corte, "desfiltro" => $desfiltro),
            'db_connection' => $pdfconec,
        ];

        $jasper = new JasperPHP;
        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        //output();
        //die($jasper->output());

        if (!isset($entrada['mail'])) {
            $content = file_get_contents($output . ".pdf");
            header('Content-Type: application/pdf');
            header('Content-Disposition:inline; filename="ctr_carga_' . $_SESSION['nroafil'] . '.pdf"');
            echo $content;
            unlink($output . ".pdf");
            exit();
        }

    }
    
    public function listarOrdenPractica($entrada)
    {
      if(isset($entrada['param'])){
         $entrada = base64_decode($entrada['param']);
         parse_str($entrada, $entrada);
      };
  
      
      $reportName = ($entrada["tipoorden"] == 0 ? 'orden_practica' : '');
      $urlimg = HOMEDIR . '/img/logo_pdf_' . $_SESSION['cod_obsoc'] . '.jpg';
      if ($_SESSION['cod_obsoc'] == ACTOMED) {
        $reportName = ($entrada["tipoorden"] == 0 ? 'orden_practicaiapos' : '');
        $urlimg = HOMEDIR . '/img/logo_pdf_iapos.jpg';
      }
     
      $input  = HOMEDIR . '/reportes/'.$reportName.'.jasper';
      $output = HOMEDIR . '/tmp/'.$reportName . $entrada["nroorden"];
  
  
      $where  =  $entrada["nroorden"] .",". $entrada["sucursal"] ;
      $copia  =  (isset($entrada["copia"]))?$entrada["copia"]:'' ;
      $observa  =  (isset($entrada["observa"]))?$entrada["observa"]:'' ;
      $diagno  =  (isset($entrada["diagno"]))?$entrada["diagno"]:'' ;
    
      
   //die($reportName.'  '. $urlimg);
      $jdbc_dir = HOMEDIR . '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc';
      $pdfconec = json_decode(DesEncriptarCadena(utf8_decode($_SESSION['pdfconec'])));
      //die(DesEncriptarCadena(utf8_decode($_SESSION['pdfconec'])));
      $options  = [
        'format'        => ['pdf'],
        'locale'        => 'es',
        'params'        => array("observa" => $observa, "copia" => $copia,  "diagno" => $diagno, "urlimg" => $urlimg, "where" => $where),
        'db_connection' => $pdfconec,
      ];
      $jasper = new JasperPHP;
      $jasper->process(
        $input,
        $output,
        $options
      )->execute();
      //output();
      //execute();
 // die($jasper->output());
  
     if (!isset($entrada['mail'])){
        if (!file_exists($output . ".pdf")) die("Error en archivo");
        $content = file_get_contents($output . ".pdf");
        header('Content-Type: application/pdf');
        header('Content-Disposition:inline; filename="ordenpractica_' . $entrada["nroorden"] . '.pdf"');
        echo $content;
        unlink($output . ".pdf");
        exit();
      }
   
  
    }

    public function imprimeOrden($entrada)
    {

        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };
      
        $cod_obsocConec = (isset($entrada['obsobweb'])) ? $entrada['obsobweb'] :  $_SESSION['cod_obsoc'];     
   
        $obsocSess = $_SESSION['cod_obsoc'];
        if (isset($entrada['codinterno'])>0){
            $_SESSION['cod_obsoc'] = $entrada['codinterno'] ;
        }else{
            $_SESSION['cod_obsoc'] = $cod_obsocConec ;
        }
        
        $error = DB::Connect(); 
        if ($error) die($error);        
        $reportName = 'orden_practicaodont';
        $input      = HOMEDIR . '/reportes/' . $reportName . '.jasper';
        $output     = HOMEDIR . '/tmp/orden_pracodont_' . $_SESSION['nroafil'];
        $where      = $entrada['nro_orden'];
        $urlimg     = HOMEDIR . '/img/logo_pdf_' . $_SESSION['cod_obsoc'] . '.jpg';
    
        $jdbc_dir = HOMEDIR . '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc';
        $pdfconec = json_decode(DesEncriptarCadena($_SESSION['pdfconec']));
        $options  = [
            'format'        => ['pdf'],
            'locale'        => 'es',
            'params'        => array("where" => $where, "urlimg" => $urlimg),
            'db_connection' => $pdfconec,
        ];

        $jasper = new JasperPHP;
        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        //)->output();
        //die($jasper->output());
        
        $_SESSION['cod_obsoc'] = $obsocSess;
        if (!isset($entrada['mail'])) {
            $content = file_get_contents($output . ".pdf");
            header('Content-Type: application/pdf');
            header('Content-Disposition:inline; filename="orden_pracodont_' . $_SESSION['nroafil'] . '.pdf"');
            echo $content;
            unlink($output . ".pdf");
            exit();
        }
      
    }

    public function get_afil($entrada)
    {

        if ($entrada['cod_obsoc'] > 0) {

            $where   = array('codigo' => $entrada['cod_obsoc']);
            $success = DB::SelectValue('whal.tobrasoc', 'padronsn', $where);
            $nuevo   = ($success < 1 ? 'nuevo' : '');
            $this->smarty->assign('boton', $nuevo);
            $this->smarty->assign('ruta', $this->ruta);
            $this->smarty->assign('modulo', 'afiliado');
            $this->smarty->display('afil.tpl');
        }
    }
    public function get_obsoc($entrada)
    {
        
        $region = $entrada['cod_region'];

        $this->smarty->assign('obrasoc', fnccomboDB("whal.qryregionobsoc", "codigo", "descripcion", "codigo", "codregion = " . $region . " "));
        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->display('obsoc.tpl');

    }

    public function aut_dia($entrada)
    {
       
        $this->smarty->assign('ruta', $this->ruta);
        $this->smarty->display('aut_dia.tpl');
    }
   

    public function valida_ingresa($entrada)
    {
        
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
    
        
        $error = DB::Connect(); 
        if ($error) die($error);
        
        $json =json_encode($entrada);
       // die(($json));
        $sql    = 'EXEC  WHAL.OL_JSValidaAut :vjson;';
        $values = array('vjson' => $json);
       
        $datos = DB::QueryRow($sql, $values);

        $_SESSION['cod_obsoc'] = $obsocSess;
        return json_encode($datos);
    }

    public function sumaCoseguro($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
    
        
        $error = DB::Connect(); 
        if ($error) die($error);

        $json  = json_encode($entrada);
       
        $sql    = 'EXEC  WHAL.OlSumaCoseguro :json ;';
        $values = array('json' => $json);
       
        $datos = DB::QueryRow($sql, $values);

        $_SESSION['cod_obsoc'] = $obsocSess;
        return json_encode($datos);
    }
    public function controlPlanAsoc($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
        die($obsocSess);
        
        $error = DB::Connect(); 
        if ($error) die($error); 

      
        //@Matricula int, @Cod_Prestador int, @Cod_plan int
        $sql    = 'EXEC  WHAL.ol_validaplanol :matricula, :cod_prestador, :cod_plan ';
        $values = array('matricula' => $entrada['matriculaefec'], 'cod_prestador' => $entrada['minstituciones_id'], 'cod_plan' =>$entrada['cod_plan']);
 
        $datos = DB::Query($sql, $values); 
        {
            $_SESSION['cod_obsoc'] = $obsocSess;
            return json_encode($datos[0]);
          }  
    }


    public function save($entrada)
    {
      
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };

        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;
        
        $error = DB::Connect(); 
        if ($error) die($error); 

      $json =json_encode($entrada);
     //die($json);
      $sql    = 'EXEC  WHAL.ol_jsgrabaaut :vjson;';
      $values = array('vjson' => $json);
      
      $datos = DB::QueryRow($sql, $values);
       //die(var_dump($datos));  
      
      $_SESSION['cod_obsoc'] = $obsocSess;
        if (!$datos) {
            $estado = array('cod_error' => 1, 'mensaje' => 'Error en grabacion ');            
        }else{
            $estado = array('cod_error' => $datos['estado'], 'mensaje' => 'Grabo correctamente ');
            $nroorden = $datos['nroorden'];
            $obsobweb = $datos['obsobweb'];
            $sucursal = 0;
            $tipoorden = 0;
            
            if($datos['estado'] == 0){
                $estado = array('cod_error' => 0,'mensaje' => 'Grabo correctamente ' ,  'param' => "ruta=".$this->ruta."&obsobweb=".$obsobweb."&nro_orden= ".$nroorden."");
                echo "javascript: link_ajax('/base/" . $this->ruta . "/listarOrdenPractica.php?ruta=".$this->ruta."&obsobweb=".$obsobweb."&nroorden= ".$nroorden."&sucursal= ".$sucursal."&tipoorden= ".$tipoorden."','div_principal','form_list_aut', 'si');";
            }
           
          }     
            
            return $estado;
          
    }

    public function listar($entrada)
  {
  
    if(isset($entrada['param'])){
       $entrada = base64_decode($entrada['param']);
       parse_str($entrada, $entrada);
    };

    $reportName = ($entrada["tipoorden"] == 0 ? 'cupon_consumo' : 'cupon_interna')  ;
   
    $input  = HOMEDIR . '/reportes/'.$reportName.'.jasper';
    $output = HOMEDIR . '/tmp/'.$reportName.$entrada["nroorden"];


    $where  =  $entrada["nroorden"] ;
    $operador  =   isset($entrada["operador"]) ? $entrada["operador"] : '';
    $copia  =   isset($entrada["copia"]) ? $entrada["copia"] : '';
    $auditor  =   isset($entrada["auditor"]) ? $entrada["auditor"] : '';
    $diagno  =   isset($entrada["diagno"]) ? $entrada["diagno"] : ''; 
    $urlimg = HOMEDIR . '/img/logo_pdf_' . $_SESSION['cod_obsoc'] . '.jpg';
	
	 if ($_SESSION['cod_obsoc'] == ACTOMED) {
     // $reportName = ($entrada["tipoorden"] == 0 ? 'orden_practicaiapos' : '');
      $urlimg = HOMEDIR . '/img/logo_pdf_iapos.jpg';
    }

    $jdbc_dir = HOMEDIR . '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc';
    $pdfconec = json_decode(DesEncriptarCadena($_SESSION['pdfconec']));
    $options  = [
      'format'        => ['pdf'],
      'locale'        => 'es',
      'params'        => array("Operador" => $operador, "Copia" => $copia, "auditor" => $auditor, "Diagno" => $diagno, "urlimg" => $urlimg, "where" => $where),
      'db_connection' => $pdfconec,
    ];
    $jasper = new JasperPHP;
    $jasper->process(
      $input,
      $output,
      $options
    )->execute();
 //   die($jasper->output());

   if (!isset($entrada['mail'])){
    // die($output . ".pdf");
      $content = file_get_contents($output . ".pdf");
      header('Content-Type: application/pdf');
      header('Content-Disposition:inline; filename="orden_' . $entrada["nroorden"] . '.pdf"');
      echo $content;
      unlink($output . ".pdf");
      exit();
    }
 

  }

    public function carga_img($entrada)
    {
        if (isset($entrada['param'])) {
            $entrada = base64_decode($entrada['param']);
            parse_str($entrada, $entrada);
        };
        $cod_obsocConec = (isset($entrada['cod_obsocconec'])) ? $entrada['cod_obsocconec'] :  $_SESSION['cod_obsoc'];     
        $obsocSess = $_SESSION['cod_obsoc'];
        $_SESSION['cod_obsoc'] = $cod_obsocConec ;

        if (leerentrada("accion") == 'guardar') {
            $count = count($_FILES['file']['name']);
            $nroRandom = rand();
            for ($i = 0; $i < $count; $i++) {
                $estado = array('cod_error' => 1, 'mensaje' => 'Archivo inválido');                

                if (isset($_FILES['file']['tmp_name'][$i]) &&  strlen($_FILES['file']['tmp_name'][$i]) > 1 && $_FILES["file"]["size"][$i] < 6 * MB) {
                    $allowedFileType = ['image/png', 'image/jpg', 'image/jpeg', 'application/pdf', 'application/msword'];
                    
                    if (in_array($_FILES["file"]["type"][$i], $allowedFileType)) {                        
                        $filename = "archivo_" . $nroRandom . "_" . $i . "_" . date('d_m_y');
                        // Location
                        $obsoc = $_SESSION['cod_obsoc'];
                        $targetDir = HOMEDIR . '/archivosaut/' . $obsoc;
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        $location = $targetDir . "/" . $_FILES['file']['name'][$i];
                        // file extension
                        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
                        $location = $targetDir . "/" . $filename . "." . $file_extension;
                        // Valid extension
                        $img_ext = array('png', 'jpeg', 'jpg');

                        if (in_array($file_extension, $img_ext)) {
                            $quality = $_FILES["file"]["size"][$i] < 2 * MB ? 75 : 30;
                            // Compress Image
                            $success = $this->compressImage($_FILES['file']['tmp_name'][$i], $location, $quality);
                        } else {
                            $success =  move_uploaded_file($_FILES['file']['tmp_name'][$i], $location);
                        }
                        if (isset($error)) {
                            $estado = array('cod_error' => 1, 'mensaje' => 'Error en archivo ' . json_encode($error) . '');
                            return json_encode($estado);
                        } else {
                            $imgurl[] =  $filename . "." . $file_extension;

                            $estado = array('cod_error' => 0, 'mensaje' => 'Envio correcto');
                           
                        }                        
                    } else {
                        $estado = array('cod_error' => 1, 'mensaje' => 'Archivo inválido ' . $i);
                        return json_encode($estado);
                    }
                }
            }
            if ($estado['cod_error'] == 0) {
                 
                $entrada['files'] = array("img" => json_encode($imgurl, JSON_UNESCAPED_SLASHES));
                $estado = $this->save($entrada);
               // $conv = json_encode($entrada, JSON_UNESCAPED_SLASHES);
              //  $conv = array("\\" => "", "\"[" => "[", "]\"" => "]");

             // $entrada = strtr(json_encode($entrada), $conv);
              
                	
            }

            $_SESSION['cod_obsoc'] = $obsocSess;
            return json_encode($estado);
        } else {
           
            
        }
    }
    
   

    function path2url($file, $Protocol = 'http://')
    {
        return $Protocol . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
    }

    // Compress image
    public function compressImage($source, $destination, $quality)
    {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }

        return imagejpeg($image, $destination, $quality);
    }

    public function __destruct()
    {
    }

}
