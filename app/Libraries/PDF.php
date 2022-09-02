<?php
#http://www.fpdf.org/
require(APPPATH .'ThirdParty/fpdf/fpdf.php');
require(APPPATH .'ThirdParty/phpqrcode/qrlib.php');
#use FPDF;
class PDF extends FPDF
{
protected $col = 0; // Current column
protected $y0;      // Ordinate of column start
#public $content = "This content presents the whole volume of information presented on this document codified in QR Code";
public $content = "Esse texto é apresentado como o contéudo do documento. Tudo o que pode ser transmitido é transcrito para as páginas. \n \t Esse texto se encontra codificado no QR Code próximo a esses parágrafos. Assim o conteúdo é preservado de mais de uma forma.";
public $genTitle;

function Header()
{
    // Page header
    global $title;

    $title = utf8_decode("Relatório");
    $this->SetFont('Arial','B',15);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    $this->SetLineWidth(1);
    $this->Cell($w,9,$title,1,1,'C',true);
    $this->Ln(10);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function Footer()
{
    // Page footer
    if($this->PageNo()==2){
        QRcode::png($this->content,"test2.png");
        $this->Image("test2.png", 100, 200, 50, 50, "png");
    }

    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    #QRcode::png("24640003","test2.png");
    #$this->Image("test2.png", 40, 10, 20, 20, "png");
}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
    // Method accepting or not automatic page break
    if($this->col<2)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        // Set ordinate to top
        $this->SetY($this->y0);
        // Keep on page
        return false;
    }
    else
    {
        // Go back to first column
        $this->SetCol(0);
        // Page break
        return true;
    }
}

function ChapterTitle($num, $label)
{
    // Title
    $this->SetFont('Arial','',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6,utf8_decode("Capítulo $num : $label"),0,1,'L',true);
    $this->Ln(4);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function ChapterBody($file)
{
    // Read text file
    $txt = "Conteúdo do primeiro capítulo/parte";
    $txt=$this->content;
    // Font
    $this->SetFont('Times','',12);
    // Output text in a 6 cm width column
    $this->MultiCell(60,5,utf8_decode($txt));
    $this->Ln();
    // Mention
    $this->SetFont('','I');
    $this->Cell(0,5,'(fim da parte)');
    // Go back to first column
    $this->SetCol(0);
}

function PrintChapter($num, $title, $file)
{
    // Add chapter
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file);

}
}

$pdf = new PDF();
$title = utf8_decode('Relatório PGDs');
$pdf->SetTitle($title);
$pdf->SetAuthor('DEV');
$pdf->PrintChapter(1,'Primeiro capítulo','20k_c1.txt');
$pdf->PrintChapter(2,'Segundo capítulo','20k_c2.txt');
$pdf->AddPage();
QRcode::png($pdf->content,"test2.png");
$pdf->Image("test2.png", 50, 50, 100, 100, "png");
$pdf->Output();
?>