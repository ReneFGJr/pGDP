<?php

namespace App\Models\Dmp;

use CodeIgniter\Model;

use FPDF;
use PDF;

class Pdf extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pdfs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

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
