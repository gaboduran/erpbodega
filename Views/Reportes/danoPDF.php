<?php
require('fpdf/fpdf.php');

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
            $this->Cell(98);

            $this->Cell(20,10,'LISTADO GENERAL DAÑOS',0,0,'C');

            // Line break
            $this->Ln(20);
        }
    }


// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(160,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
        $this->Cell(43.2,10,date('d/m/Y H:i:s'),0,0,'C');
    }
}

spl_autoload_register(function($className){
    $model = "../../Config/app/". $className .".php";
   // echo $model;
    require_once($model);
});

$objGrupo = new db();

$stringSQL = "SELECT ID, CODDANO, NOMBRESP, NOMBREIN, CASE WHEN dano.ESTADO = 1 THEN 'activo' ELSE 'inactivo' END AS ESTADO FROM dano";
$listado = $objGrupo->SQL("$stringSQL");


try {
    // Instanciation of inherited class
    $pdf = new PDF('P','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(30,5,'CODIGO',0,0,'L',1);
    $pdf->Cell(70,5,'NOMBRESP',0,0,'L',1);
    $pdf->Cell(65,5,'NOMBREIN',0,0,'L',1);
    $pdf->Cell(36,5,'ESTADO',0,0,'C',1);
    $pdf->Line(210,28,10,28);
    $pdf->Line(210,37,10,37);
    $pdf->Ln(9);
    
    if (is_array($listado) || is_object($listado))
    {

        foreach ($listado as $row => $column) {
        
            $pdf->setX(9);
            $pdf->Cell(30,5,$column["CODDANO"],0,0,'C',1);
            $pdf->Cell(72,5,ucwords($column["NOMBRESP"]),0,0,'L',1);
            $pdf->Cell(75,5,ucwords($column["NOMBREIN"]),0,0,'L',1);
            $pdf->Cell(30,5,ucwords($column["ESTADO"]),0,0,'L',1);
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
        }
        $pdf->SetFont('Arial','B',11);


    }
    $pdf->Output('I','MaestroDanosContenedor');

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
