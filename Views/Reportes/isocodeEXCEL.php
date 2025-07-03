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
$stringSQL = "SELECT isocode.ID, CODIGO, DESCRIPCION, TAMANO, cliente.NOMCLIENTE, isocode.ESTADO, CASE WHEN isocode.ESTADO = 1 THEN 'activo' ELSE 'inactivo' END AS ESTADO
FROM isocode
INNER JOIN CLIENTE ON cliente.ID = isocode.IDLINEA";
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
          ->getColumnDimension('F')
          ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
          ->setCellValue('A1', "ID")
          ->setCellValue('B1', "CODIGO")
          ->setCellValue('C1', "DESCRIPCION")
          ->setCellValue('D1', "TAMANO")
          ->setCellValue('E1', "LINEA")
          ->setCellValue('F1', "ESTADO");
      $fila = 2;
      foreach ($resultado as $row) {
            $resultado['ID']              = $row['ID'];
            $resultado['CODIGO']          = $row['CODIGO'];
            $resultado['DESCRIPCION']     = $row['DESCRIPCION'];
            $resultado['TAMANO']          = $row['TAMANO'];
            $resultado['NOMCLIENTE']      = $row['NOMCLIENTE'];
            $resultado['ESTADO']          = $row['ESTADO'];
            $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $fila, $resultado['ID'])
            ->setCellValue('B' . $fila, strtoupper($resultado['CODIGO']))
            ->setCellValue('C' . $fila, strtoupper($resultado['DESCRIPCION']))
            ->setCellValue('D' . $fila, strtoupper($resultado['TAMANO']))
            ->setCellValue('E' . $fila, strtoupper($resultado['NOMCLIENTE']))
            ->setCellValue('F' . $fila, strtoupper($resultado['ESTADO']));
      $fila++;
      }

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="MaestroIsocode.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;

} catch (Exception $e) {


}

?>
