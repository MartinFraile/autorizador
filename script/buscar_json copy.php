<?php

require_once "../clases/funciones.php";
$script = leerentrada('script');
$id_bus = leerentrada('id_bus');
$tipo   = (leerentrada('tipo')) ? leerentrada('tipo') : "";

parse_str($_POST['datosform'], $datosform);

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
    case "buspostal":
        require_once 'buscar_postal.php';
        die(buscar_postal($id_bus, $tipo));
        break;
    case "busefector":
        require_once 'buscar_efector.php';
        die(buscar_efector($id_bus, $tipo));
        break;
    case "busefectorodon":
        require_once 'buscar_efectorodont.php';
        die(buscar_efectorodont($id_bus, $tipo, $datosform));
        break;
    case "busplan":
        require_once 'buscar_plan.php';
        die(buscar_plan($id_bus, $tipo));
        break;
    case "busplantarifa":
        require_once 'buscar_plantarifa.php';
        die(buscar_plantarifa($id_bus, $tipo, $datosform));
        break;
    case "busobsocemp":
        require_once 'buscar_obsocemp.php';
        die(buscar_obsocemp($id_bus, $tipo, $datosform));
        break;
    case "buspractiodont":
        require_once 'buscar_practicaodont.php';
        die(buscar_practicaodont($id_bus, $tipo, $datosform));
        break;
    case "buscaraodont":
        require_once 'buscar_caraodont.php';
        die(buscar_caraodont($id_bus, $tipo, $datosform));
        break;
    case "buspiezaodont":
        require_once 'buscar_piezaodont.php';
        die(buscar_piezaodont($id_bus, $tipo, $datosform));
        break;
    case "buscarempleado":
        require_once 'buscar_empleado.php';
        die(buscar_empleado($id_bus, $tipo, $datosform));
        break;
    case "buscarob":
        require_once 'buscar_ob.php';
        die(buscar_ob($id_bus, $tipo, $datosform));
        break;   
    case 2:
        echo "i es igual a 2";
        break;

}
