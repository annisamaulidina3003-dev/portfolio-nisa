<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class CvController extends Controller
{
    public function download(): Response
    {
        $pdf = Pdf::loadView('cv-pdf')->setPaper('a4');

        $filename = 'CV-'.str(config('portfolio.profile.name'))->slug().'.pdf';

        return $pdf->download($filename);
    }
}
