<?php
require_once "../../config.php";

include '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class excel
{
  private $documento;
  private $hoja;
  private $title;

  public function __construct()
  {
    $this->documento = new Spreadsheet();
    $this->documento
      ->getProperties()
      ->setCreator("Whal Software");
    $this->hoja = $this->documento->getActiveSheet();

  }

  public function setTitle($title)
  {
    $this->title = $title;
    $this->documento
      ->getProperties()      
      ->setTitle($title);
    //$this->documento->setTitle($title);
    $this->hoja->setTitle($title);
  }

  private function setHeaders($headers, $datos)  
  {
     $i = 1;
     foreach ($datos[0] as $key => $value){
        $this->hoja->setCellValueByColumnAndRow($i, 1, $key);
        $this->hoja->getCellByColumnAndRow($i, 1)->getStyle()->getFont()->setSize(16);
        $i++;
     }
  /*  $i = 1;
    foreach ($headers as $key => $value) {
      $this->hoja->setCellValueByColumnAndRow($i, 1, $value['titulo']);
      $this->hoja->getCellByColumnAndRow($i, 1)->getStyle()->getFont()->setSize(16);
      $i++;
    }*/
  }

  private function setRows($headers, $datos)
  {
    $numeroDeFila = 2;
    foreach ($datos as $row) {
      $i = 1;
     foreach ($row as $key => $value){
     //  die($row[$value]);
        $this->hoja->setCellValueByColumnAndRow($i, $numeroDeFila, $value);
        $i++;
     }
    /*  $i = 1;
      foreach ($headers as $key => $value) {
        die($value['nom_campo']);
        $this->hoja->setCellValueByColumnAndRow($i, $numeroDeFila, $row[$value['nom_campo']]);
        $i++;
      }*/
      $numeroDeFila++;
    }
  }

  public function generar($headers, $datos)
  {
    $this->setHeaders($headers, $datos);
    $this->setRows($headers, $datos);
    $writer = new Xlsx( $this->documento);
    $name   = $this->title. '.xlsx';
    $output = HOMEDIR . '/tmp/' . $name;
    # Le pasamos la ruta de guardado
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $name . '"');
    header('Cache-Control: max-age=0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');
    $writer->save('php://output');
  }

}
