<?php
session_start();
require_once('../../../Teus/vendor/autoload.php');
require_once('../../../Teus/Models/Conexion.php');
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
//phpspreadsheet Date class
use PhpOffice\PhpSpreadsheet\Shared\Date;
//phpspreadsheet numberformat style class
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
//make a new spreadsheet object
$spreadsheet  = new Spreadsheet();
//Creamos $db la instacia de la Base de Datos 
$db = new Conexion();
$idpreasigna = $_GET['idpreasigna'];
$stringSQL = "SELECT preasignacionesdet.ID, CONTENEDOR, CODIGO, preasignaciones.IDLINEA, NOMCLIENTE
                  FROM preasignacionesdet
                  INNER JOIN preasignaciones ON preasignaciones.ID = preasignacionesdet.IDPRESASIGNACION
                  INNER JOIN cliente ON cliente.ID = preasignaciones.IDLINEA
                  INNER JOIN tipocont ON tipocont.ID = preasignacionesdet.TIPO
                  WHERE IDPRESASIGNACION = {$idpreasigna}";
//Ejecutamos la consulta y queda almacenada como un array en la variable $resultado
$resultado = $db->query($stringSQL, []);
try {
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getDefaultStyle()
          ->getFont()
          ->setName('Arial')
          ->setSize(10);
    //set column dimension to auto size
    $spreadsheet->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()
          ->getColumnDimension('A')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->getColumnDimension('B')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->getColumnDimension('C')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->setCellValue('A1', "CONTENEDOR")
          ->setCellValue('B1', "TIPO")
          ->setCellValue('C1', "LINEA");
      $fila = 2;
      foreach ($resultado as $row) {
            $resultado['CONTENEDOR']   = $row['CONTENEDOR'];
            $resultado['CODIGO']       = $row['CODIGO'];
            $resultado['NOMCLIENTE']   = $row['NOMCLIENTE'];
            $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $fila, strtoupper($resultado['CONTENEDOR']))
            ->setCellValue('B' . $fila, strtoupper($resultado['CODIGO']))
            ->setCellValue('C' . $fila, strtoupper($resultado['NOMCLIENTE']));
      $fila++;
      }
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="listadoPreasignaciones.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;

} catch (Exception $e) {


}

?>
