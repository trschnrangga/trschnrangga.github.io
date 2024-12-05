<?php
require('fpdf/fpdf186/fpdf.php'); // fpdf lib
include 'config.php'; // database connect

class PDF extends FPDF {

    function Header() {

        $this->SetFont('Arial', 'B', 16);

        $this->Cell(0, 10, 'UNIVERSITY OF GLYPH', 0, 1, 'C');
        $this->Ln(2); 

        $this->SetFont('Arial', 'I', 14);
        $this->Cell(0, 10, 'LIST OF SOFTWARE ENGINEERING 2023 STUDENTS', 0, 1, 'C');
        $this->Ln(10); 
    }


    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// table header
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(40, 10, 'Name', 1);
$pdf->Cell(50, 10, 'Email', 1);
$pdf->Cell(20, 10, 'Age', 1);
$pdf->Cell(60, 10, 'Course', 1);
$pdf->Ln();

// fetch data from database
$result = $conn->query("SELECT * FROM students");

$pdf->SetFont('Arial', '', 12);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['id'], 1);
    $pdf->Cell(40, 10, $row['name'], 1);
    $pdf->Cell(50, 10, $row['email'], 1);
    $pdf->Cell(20, 10, $row['age'], 1);
    $pdf->Cell(60, 10, $row['course'], 1);
    $pdf->Ln();
}


$pdf->Output('D', 'students.pdf');
?>
