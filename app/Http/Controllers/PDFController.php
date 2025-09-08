<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PDFController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function generatePDF(Request $request)
    {
        $data = $request->all();

        return view('pdf-output', compact('data'));
    }

    public function downloadPDF(Request $request)
    {
        $pdf = PDF::loadView('pdf-output', compact('data'));
        return redirect()->route('pdf-output.pdf', ['id' => $data['id']]);
    }
}
