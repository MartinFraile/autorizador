<?php
//menu.php
//require_once ("./config.php");
require_once CLASES_LOCAL . "/DB.php";
require_once CLASES_LOCAL . "/funciones.php";

class menu
{
    public $nomusu;
    private $menu;
    public function __construct($usuario)
    {
        $this->nomusu = $usuario;
        $this->menu = array();
    }

    public function armarmenu($cod_clase)
    {
        require_once CLASES_LOCAL . "/setup_smarty.php";
        $smarty = new Smarty_Whal();
        $sql    = "select * from menuaut where habilitado = 1 and cod_menupadre is null order by orden";
        $error = DB::Connect(); 
        if ($error) die($error);  
        $datos = DB::Query($sql );  
        die($datos);     
      $menu =' <ul class="sidenav" id="myNavbar">';
      $menu .='<li> <a class="iconomarca" href="#" ><img src="/base/img/logo_ingreso.png" width="65" height="35" alt=""></a></li>';

        $usermenu = "";

        foreach ($datos as $key => $valor) {
            if ($this->permisoempresa($valor['empresas_hab']) == 1) {
                if ($this->permisomenu($cod_clase, $valor['clases_opera']) == 1) {

                    if ($valor['descripcion'] == 'Usuario') {

                        $usermenu = $this->usermenu($valor['script'], $valor['descripcion'], $cod_clase, $valor['cod_menu']);
                    }
                    if ($valor['script'] == '' && $valor['descripcion'] != 'Usuario') {
                        $menu .= '<li  ><a class="collapse"  data-toggle="collapse" aria-expanded="false" href="#menu_' . $valor['cod_menu'] . '" >' . $valor['descripcion'] . '</a>';
                        $menu .= $this->armasubmenu($cod_clase, $valor['cod_menu']);
                    } else if ($valor['descripcion'] != 'Usuario') {
                        $menu .= '<li  ><a  href="' . $valor['script'] . '" >' . $valor['descripcion'] . '</a>';
                    }
                    $menu .= '</li>';
                }
            }

        }
       // $menu .= '</ul>' . $usermenu . '</nav>';
        $menu .= '  <li class="nav-right"><a href="./salir.php" >Salir</a></li><li> <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a></li></ul>';
       // $menu .=  '</nav>';
        $this->menu['principal'] = $menu;
        //$this->menu['usuario'] = $usermenu;
        $this->menu['usuario'] = strtoupper($this->nomusu);
        $this->menu['cod_club'] = $_SESSION['cod_club'];
        //die($menu);
        return $this->menu;
    }

    public function armasubmenu($cod_clase, $cod_menupadre)
    {
        $sql = "select * from menuaut where habilitado = 1 and  cod_menupadre =" . $cod_menupadre . "  order by orden";
        $datos = DB::Query($sql );     
        $menu  = '';

        foreach ($datos as $key => $valor) {
            if ($this->permisoempresa($valor['empresas_hab']) == 1) {
                if ($this->permisomenu($cod_clase, $valor['clases_opera']) == 1) {

                    if ($valor['script'] == '') {
                        $menu .= '<a   data-toggle="collapse" aria-expanded="false" href="#menu_' . $valor['cod_menu'] . '" ><i class="fas fa-angle-right"></i> &nbsp;&nbsp;&nbsp;' . $valor['descripcion'] . ' </a>';           
                    } else {
                        $menu .= '<a href="' . $valor['script'] . '" >&nbsp;&nbsp;&nbsp;' . $valor['descripcion'] . ' </a>';
                    }
                    $menu .= $this->armasubmenu($cod_clase, $valor['cod_menu']);
                    $menu .= '';
                }
            }

        }

        if ($menu != ''  && $cod_menupadre != 2 ) { 
            $menu = '<ul class=" list-unstyled " id="menu_' . $cod_menupadre . '" >' . $menu . '</ul>';
        }
          if ($menu != '' && $cod_menupadre == 2 ) { 
            $menu = $menu ;
        }

        return $menu;
    }

    public function usermenu($script, $descripcion, $cod_clase, $cod_menupadre)
    {
        $usermenu = '<ul class="nav justify-content-center"><div name="div_bandeja_msj" id="div_bandeja_msj"></div>     
                <li class="nav-item dropdown"><a  class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#menu_' . $cod_menupadre . '" >' . strtoupper($this->nomusu) . '</a> 
                 <div class="dropdown-menu  dropdown-menu-right">';
        $usermenu .= $this->armasubmenu($cod_clase, $cod_menupadre);
        $usermenu .= '</div></li> </ul> ';

//die($usermenu);
        //$usermenu .= ' </ul>';
        return $usermenu;
    }

    public function permisomenu($cod_clase, $clases_opera)
    {
        $clasesop = explode(',', $clases_opera);
        if (in_array($cod_clase, $clasesop)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function permisoempresa($empresas_habilitadas)
    {
        $empresa_hab = explode(',', $empresas_habilitadas);
        //die("llega ses = " . $_SESSION['cod_club'] ." empresdas= ".var_dump($empresa_hab));
        if (in_array($_SESSION['cod_club'], $empresa_hab)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function __destruct()
    {
    }

}
