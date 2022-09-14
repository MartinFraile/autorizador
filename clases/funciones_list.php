<?php
//session_start();
require_once 'DB.php';
class funciones_list
{
    private $recordSet;
    private $columnSet;

    //Generales
    public $prefijo = 'WHAL';
    public $ruta;
    public $script_name;
    public $columnas_seteadas = false;
    public function __construct()
    {
        $script_name       = $_SERVER["SCRIPT_NAME"];
        $path              = Explode('/', $script_name);
        $script_name       = $path[count($path) - 1];
        $this->script_name = $script_name;
        //$this->ruta        = $path[count($path) - 3] . '/' . $path[count($path) - 2];
        $this->ruta = dirname($_SERVER['SCRIPT_NAME']);
    }

    public function mostrar($sql, $smarty, $cantRow = 5)
    {
        if ($sql != '') {
            $error = DB::Connect();
            if ($error) {
                die($error);
            }

            $recordSet       = DB::Query($sql);
            $this->recordSet = $recordSet; //Si no especifica tamaño, pongo todo
            // $db->desconectar();
        }

        unset($recordSet);

        if (!is_array($this->columnSet)) //Si no es array, no setea columnas, por que no hay registros
        {
            $this->setear_columnas();
        }

        $this->setear_datos();
  //die(json_encode($this->columnSet));
        $smarty->assign('data', json_encode($this->recordSet));
        $smarty->assign('headers', json_encode($this->columnSet));
        $smarty->assign('cantRow', $cantRow);

    }

    public function nueva_columna($nom_campo, $alias_campo, $opciones = array())
    {
        $this->columnas_seteadas = true;
        $nueva_columna           = array(
            'script_name' => $this->script_name,
            'ruta'        => $this->ruta,
            'label'       => $alias_campo,
            'name'        => $nom_campo,
            'hidden'      => (isset($opciones['hidden'])) ? $opciones['hidden'] : '',
            'opciones'    => $opciones,
        );
//die(var_dump($nueva_columna));
        $this->columnSet[] = $nueva_columna;
    }
    public function nueva_columna_opciones($columna, $registro)
    {
        $columna['opciones']['funcion'] = isset($columna['opciones']['funcion']) ? $columna['opciones']['funcion'] : '';
        if ($columna['opciones']['funcion'] != '') {
            require_once $columna['opciones']['clase'] . '.php';
            eval('$clase = new ' . $columna['opciones']['clase'] . ';');
            eval('$result = $clase->' . $columna['opciones']['funcion'] . '($columna, $registro);');

        } else {
            $result = $registro[$columna['name']];
        }

        return $result;
    }

    public function setear_columnas()
    {
        if (is_array($this->recordSet[0])) {
            foreach ($this->recordSet[0] as $clave => $valor) {
                $this->columnSet[] = array(
                    'ruta'  => $this->ruta,
                    'label' => $clave,
                    'name'  => 'namename',
                );
            }
        }
    }

    public function setear_datos()
    {
        $recordSet = $this->recordSet;

        if (is_array($recordSet)) {
            foreach ($recordSet as $id => $registro) {
                //Me fijo si esta seteado en al columna
                if ($this->columnas_seteadas == true) {
                    foreach ($this->columnSet as $id_columna => $columna) {
                        $this->recordSet[$id][$columna['name']] = $this->nueva_columna_opciones($columna, $recordSet[$id]);

                    }
                }
            }
        }

        unset($recordSet);
    }

}

class trListado
{
    public $label;
    public $name;
    public $class;
    public $hidden;

    public function __construct($data)
    {
        $this->label  = strtoupper($data['label']);
        $this->name   = strtolower($data['name']);
        $this->class  = isset($data['class']) ? $data['class'] : "";
        $this->hidden = isset($data['hidden']) ? $data['hidden'] : "";
    }

}
