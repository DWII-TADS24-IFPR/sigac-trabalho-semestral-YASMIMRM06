<?php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function generate()
    {
        $user = auth()->user();
        $totalHours = $user->activities()->where('status', 'approved')->sum('hours');
        
        if ($totalHours < 120) {
            return back()->with('error', 'Você não cumpriu o mínimo de 120 horas requeridas');
        }

        $pdf = Pdf::loadView('certificates.template', [
            'user' => $user,
            'totalHours' => $totalHours,
            'date' => now()->format('d/m/Y'),
        ]);

        return $pdf->download('declaracao_horas_complementares.pdf');
    }
}