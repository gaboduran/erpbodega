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
$stringSQL = "SELECT localizacion.ID, COMPONENTE, componente.DESCRIPCION, CONCAT(PRIMERCARACTER,SEGUNDOCARACTER) AS LOCALIZACION, CASE WHEN localizacion.ESTADO = 1 THEN 'activo' ELSE 'inactivo' END AS ESTADO
FROM localizacion INNER JOIN componente ON componente.CODIGO = localizacion.COMPONENTE";
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
          ->getColumnDimension('D')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->getColumnDimension('E')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->setCellValue('A1', "ID")
          ->setCellValue('B1', "COMPONENTE")
          ->setCellValue('C1', "DESCRIPCION")
          ->setCellValue('D1', "LOCALIZACION")
          ->setCellValue('E1', "ESTADO");
      $fila = 2;
      foreach ($resultado as $row) {
            $resultado['ID']                = $row['ID'];
            $resultado['COMPONENTE']        = $row['COMPONENTE'];
            $resultado['DESCRIPCION']       = $row['DESCRIPCION'];
            $resultado['LOCALIZACION']      = $row['LOCALIZACION'];
            $resultado['ESTADO']            = $row['ESTADO'];
            $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $fila, $resultado['ID'])
            ->setCellValue('B' . $fila, strtoupper($resultado['COMPONENTE']))
            ->setCellValue('C' . $fila, strtoupper($resultado['DESCRIPCION']))
            ->setCellValue('D' . $fila, strtoupper($resultado['LOCALIZACION']))
            ->setCellValue('E' . $fila, strtoupper($resultado['ESTADO']));
      $fila++;
      }
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="MaestroLocalizacion.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;

} catch (Exception $e) {


}

?>
