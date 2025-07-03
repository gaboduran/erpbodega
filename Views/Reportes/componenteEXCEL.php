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
$stringSQL = "SELECT ID, CODIGO, DESCRIPCION, DESCRIPCION2, MAQUINARIA, ESTRUCTURA, CASE WHEN componente.ESTADO = 1 THEN 'activo' ELSE 'inactivo' END AS ESTADO
FROM componente";
//Ejecutamos la consulta y queda almacenada como un array en la variable $resultado
$resultado = $db->query($stringSQL, []);
try {
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getDefaultStyle()
          ->getFont()
          ->setName('Calibri')
          ->setSize(11);
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
          ->setCellValue('B1', "DESCRIPCION")
          ->setCellValue('C1', "DESCRIPCIN2")
          ->setCellValue('D1', "MAQUINARIA")
          ->setCellValue('E1', "ESTRUCTURA")
          ->setCellValue('F1', "ESTADO");
      $fila = 2;
      foreach ($resultado as $row) {
            if ($row["MAQUINARIA"] == 1){
                $maquinaria = 'VERDADERO';
            }else{
                $maquinaria = 'FALSO';
            }
            if ($row["ESTRUCTURA"] == 1){
                $estructura = 'VERDADERO';
            }else{
                $estructura = 'FALSO';

            }
            $resultado['ID']              = $row['ID'];
            $resultado['CODIGO']          = $row['CODIGO'];
            $resultado['DESCRIPCION']     = $row['DESCRIPCION'];
            $resultado['DESCRIPCION2']    = $row['DESCRIPCION2'];
            $resultado['ESTADO']          = $row['ESTADO'];
            $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $fila, $resultado['ID'])
            ->setCellValue('B' . $fila, strtoupper($resultado['DESCRIPCION']))
            ->setCellValue('C' . $fila, strtoupper($resultado['DESCRIPCION2']))
            ->setCellValue('D' . $fila, $maquinaria)
            ->setCellValue('E' . $fila, $estructura)
            ->setCellValue('F' . $fila, strtoupper($resultado['ESTADO']));
      $fila++;
      }

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="MaestroComponente.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;

} catch (Exception $e) {


}

?>
