<?php

namespace App\Http\Controllers;

use App\Models\Requeriment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function downloadPdf(String $id)
    {
        $requeriment = Requeriment::find($id);

        $imagemPath = public_path('assets/img/LOGO01.png');
        $imagemData = File::get($imagemPath);
        $imagemBase64 = base64_encode($imagemData);

        $data = [
            'requeriment' => $requeriment,
            'imagemBase64' => $imagemBase64,
        ];

        // return view('admin.requeriments.pdf.pdf',[
        //     'data' => $data,
        // ]);

        $pdf = PDF::loadView('admin.requeriments.pdf.pdf', ['data' => $data]);

        return $pdf->stream($requeriment->destinatario . '.pdf');
    }
}
