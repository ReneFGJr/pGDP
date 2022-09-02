<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use FPDF;
use PDF;


class Pages extends Controller
{

    public function index()
    { #primeiro método chamado, com nenhum parâmentro na url
        return view('welcome_message'); #retorno de uma view

    }

    public function acesso($page = 'home')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page);

        echo view('templates/header', $data);
        #file();
        echo view('pages/' . $page);
        echo view('templates/footer');
    }

    function genFile()
    {
        require("../Libraries/PDF.php");
        $pdf = new FPDF("L","mm","A4");
        $this->fpdf->setAuthor("Autor");
        $this->fpdf->SetTitle('TESTE',0);
        $this->fpdf->AliasNbPages('(np)');
        $this->fpdf->SetAutoPageBreak(false);
        $this->fpdf->SetMargins(8,8,8,8);
        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(95,10,'',0,0,"L");
        $this->fpdf->SetTextColor(0,0,255);
        $this->fpdf->Cell(2,-6,"teste 1",0,0,"C");

        echo $this->fpdf->Output("test.pdf");

    }

    public function file()
    {
        $pdf = new PDF();
        $title = 'Relat';
        $pdf->SetTitle($title);
        $pdf->SetAuthor('Jules Verne');
        $pdf->PrintChapter(1, 'A RUNAWAY REEF', '20k_c1.txt');
        $pdf->PrintChapter(2, 'THE PROS AND CONS', '20k_c2.txt');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
