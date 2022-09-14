<?php
require_once "../clases/funciones.php";
$script = leerentrada('script');
$id_bus = leerentrada('id_bus');
$tipo   = (leerentrada('tipo')) ? leerentrada('tipo') : "";

switch ($script) {
    case "buspersonas":
        require_once 'buscar_persona.php';
        die(buscar_persona($id_bus, $tipo));
        break;
    case "busproveedores":
        require_once 'buscar_proveedor.php';
        die(buscar_proveedor($id_bus, $tipo));
        break;
    case "busclientes":
        require_once 'buscar_cliente.php';
        die(buscar_cliente($id_bus, $tipo));
        break;
    case "buscobradores":
        require_once 'buscar_cobrador.php';
        die(buscar_cobrador($id_bus, $tipo));
        break;
    case "busproductos":
        require_once 'buscar_producto.php';
        die(buscar_producto($id_bus, $tipo));
        break;   
    case 2:
        echo "i es igual a 2";
        break;
}
