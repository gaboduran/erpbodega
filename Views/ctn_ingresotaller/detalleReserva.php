<?php

ob_start();
require('fpdf/fpdf.php');



//    $Name = $_GET['idreserva'];
class PDF extends FPDF
{
    

    // Page header
    function Header()
    {

        if ($this->page == 1)
        {
            // Logo
            //  $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(105);
            // Title
            $this->Cell(105,10,'DETALLE RESERVA',0,0,'C');

            // Line break
            $this->Ln(20);
        }
    }

// Page footer
    function Footer()
    {
        $usuarioimprime = 'Usuario Imprime: '.strtoupper($_SESSION['usuario']);
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(80,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
        $this->Cell(150.2,10,$usuarioimprime,0,0,'C');
        $this->Cell(100.2,10,date('d/m/Y H:i:s'),0,0,'C');
    }
}


try {


   $id = $_GET['id'];
    $detalleReserva = reservaModel::getAlldetalleReservaPDF($id);
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(25,5,'CIR',0,0,'L',1);
    $pdf->Cell(40,5,'CONTENEDOR',0,0,'L',1);
    $pdf->Cell(40,5,'TAMANO - TIPO',0,0,'L',1);
    $pdf->Cell(50,5,'ESTADO SALIDA',0,0,'L',1);
    $pdf->Cell(50,5,'CLIENTE',0,0,'C',1);
    $pdf->Cell(42,5,'FECHA SALIDA',0,0,'C',1);
    $pdf->Cell(60,5,'INSPECTOR',0,0,'C',1);

    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);
    $total = 0;

    if (isset($detalleReserva['status'])){
        $pdf->Cell(25,5,'No hay informacion generada para esta reserva',0,0,'L',1);
    }else{
        foreach ($detalleReserva as $row => $column) {
            $pdf->setX(9);
            $pdf->Cell(25,5,$column["IDCIR"],0,0,'L',1);
            $pdf->Cell(50,5,$column["NCONT"],0,0,'L',1);
            $pdf->Cell(35,5,$column["TAMANO"].' - '.$column["TIPOCONT"],0,0,'L',1);
            $pdf->Cell(50,5,'Apto Alimentos',0,0,'L',1);
            $pdf->Cell(50,5,'CMA-CGM',0,0,'C',1);
            $pdf->Cell(40,5,'2022-11-01 17:00:00',0,0,'C',1);
            $pdf->Cell(60,5,ucwords($column["INSPECTOR"]),0,0,'C',1);
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
            $total = $total + 1;
        }
}

    $pdf->Output('I','Clientes_Activos.pdf');

ob_end_flush(); 


} catch (Exception $e) {

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','Letter');
    $pdf->Text(50,50,'ERROR AL IMPRIMIR');
    $pdf->SetFont('Times','',12);
    $pdf->Output();

}

?>
