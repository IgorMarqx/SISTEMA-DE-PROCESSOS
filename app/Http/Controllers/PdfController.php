<?php

namespace App\Http\Controllers;

use App\Models\Requeriment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function downloadPdf(String $id)
    {
        $requeriment = Requeriment::find($id);

        $imagemPath = public_path('assets/img/logoSind.png');

        $localDate = Carbon::parse($requeriment->created_at)->locale('pt_BR')->isoFormat('DD [de] MMMM [de] YYYY');

        $data = [
            'requeriment' => $requeriment,
            'imagemPath' => $imagemPath,
            'localDate' =>$localDate
        ];

        $pdf = PDF::loadView('admin.requeriments.pdf.pdf', ['data' => $data]);

        return $pdf->stream($requeriment->destinatario . '.pdf');
    }
}
