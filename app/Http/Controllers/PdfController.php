<?php

namespace App\Http\Controllers;

use App\Models\Requeriment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function downloadPdf(String $id)
    {
        $requeriment = Requeriment::find($id);

        $mergeData = [
            'footer' => 'Rodapé do documento',
        ];
        $encoding = 'UTF-8';

        $pdf = PDF::loadView('admin.pdf', $requeriment);
        return $pdf->stream();
    }
}
