<?php

require_once "../clases/funciones.php";
$script = leerentrada('script');
$id_bus = leerentrada('id_bus');
$tipo   = (leerentrada('tipo')) ? leerentrada('tipo') : "";
//die('script '.$script.' id bus '.$id_bus.' tipo '.$tipo);
parse_str($_POST['datosform'], $datosform);
//die(var_dump($datosform));
switch ($script) {
    case "busafilnro":
        require_once 'buscar_afiliadonro.php';
        die(buscar_afiliadonro($id_bus, $tipo, $datosform));
        break;
    case "busafil":
        require_once 'buscar_afiliado.php';
        die(buscar_afiliado($id_bus, $tipo, $datosform));
        break;
    case "buspractica":    
        require_once 'buscar_practica.php';
        die(buscar_practica($id_bus, $tipo, $datosform));
        break;    
    case "busefector":
        require_once 'buscar_efector.php';
        die(buscar_efector($id_bus, $tipo));
        break;
    case "busprescriptor":
            require_once 'buscar_prescriptor.php';
            die(buscar_prescriptor($id_bus, $tipo));
            break;
    case "buspractiodont":
        require_once 'buscar_practicaodont.php';
        die(buscar_practicaodont($id_bus, $tipo, $datosform));
        break; 
    case "busdiagno":
            require_once 'buscar_diagno.php';
            die(buscar_diagno($id_bus, $tipo, $datosform));
            break;     
    case 2:
        echo "i es igual a 2";
        break;
}
