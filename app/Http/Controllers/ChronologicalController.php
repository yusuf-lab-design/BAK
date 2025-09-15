<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chronological;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ChronologicalController extends Controller
{
    public function index()
    {
        $chronologies = Chronological::orderByDesc('created_at')->get();
        return view('chronology.index', compact('chronologies'));
    }

    public function create()
    {
        $area = 'Batam';

        // mencari nomor yang belum terpakai
        $allNumbers = Chronological::whereYear('created_at', date('Y'))
            ->pluck('no')
            ->map(function ($n) {
                return intval(substr($n, -4));
            })
            ->sort()
            ->values()
            ->toArray();

        //menentukan nomor kalau ada yang kosong dari nomor urut terkecil
        $next = 1;
        foreach ($allNumbers as $num) {
            if ($num == $next) {
                $next++;
            } else {
                break;
            }
        }

        // auto generate nomor sementara
        $nextNumber = 'BAK/YMP/' . date('m') . '/' . date('y') . '/' . str_pad($next, 4, '0', STR_PAD_LEFT);

        return view('chronology.create', compact('area', 'nextNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|array|min:1',
            'kronologis' => 'required|string',
            'solutions' => 'nullable|array',
        ]);
        
        // default area
        $area = 'Batam';

        // cari nomor yang belum disimpan
        $allNumbers = Chronological::whereYear('created_at', date('Y'))
            ->pluck('no')
            ->map(function($n) {
                return intval(substr($n, -4));
            })
            ->sort()
            ->values()
            ->toArray() ?? [];

        //mencari nomor terkecil
        $next = 1;
            foreach ($allNumbers as $num) {
                if ($num == $next) {
                    $next++;
                } else {
                    break;
                }
            }

        // cek ulang apakah nomor sudah dipakai
        do {
            $nextNumber = 'BAK/YMP/' . date('m') . '/' . date('y') . '/' . str_pad($next, 4, '0', STR_PAD_LEFT);
            if (!Chronological::where('no', $nextNumber)->exists()) {
                break;
            }  
            $next++;
        } while (true);
    
        // simpan ke database
        $chronology = Chronological::create([
            'judul' => null,
            'status' => 'draft',
            'no' => $nextNumber,
            'area' => $area,
            'date' => $request->created_at ?? now(),
            'subject' => $request->subject,
            'kronologis' => $request->kronologis,
            'solutions' => $request->solutions,
        ]);

        // pastikan folder pdf ada
        $path = storage_path('app/public/pdf');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        //generate pdf
        $pdf = Pdf::loadView('chronology.pdf', compact('chronology'));

        //simpan file di storage/app/public/pdf/
        $fileName = str_replace('/', '-', $chronology->no) . '.pdf';
        $pdf->save($path . '/' .$fileName);

        return redirect()->route('chronology.preview', $chronology->uuid)
        ->with('success', 'Berita acara berhasil disimpan dengan nomor : ' . $chronology->no);
    }

    public function preview(Chronological $chronology)
    {
        return view('chronology.pdf', [
            'chronology' => $chronology,
            'tanggal' => $chronology->created_at->format('d/m/Y'),
            'isPdf' => false
        ]);
    }

    public function download(Chronological $chronology)
    {
        $pdf = \PDF::loadView('chronology.pdf',['isPdf' => true, 'chronology' => $chronology,])
                ->setPaper('A4', 'potrait');
        
        // penamaan file sesuai nomor dokumen
        $fileName = str_replace('/', '-', $chronology->no) . '.pdf';
        return $pdf->download($fileName);
    }

    public function edit(Chronological $chronology)
    {
        return view('chronology.edit', compact('chronology'));
    }

    public function update(Request $request, $uuid)
    {
        $chronology = Chronological::where('uuid', $uuid)->firstOrFail();

        $chronology->solutions = $request->solutions;
        $chronology->status = 'draft';

        $chronology->save();

        return redirect()->route('chronology.index')->with('success', "Berita Acara Diperbaharui");
    }

    public function uploadForm($uuid)
    {
        $chronology = Chronological::where('uuid', $uuid)->firstOrFail();
        return view('chronological.upload', compact('chronology'));
    }

    public function upload(Request $request, $uuid)
    {
        $chronology = Chronological::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'signed_document' => 'required|file|mimes:pdf|max:2048',
        ]);

        $signedPath = $request->file('signed_document')->store('signed_docs');
        
        $chronology->signed_file_path = $signedPath;
        $chronology->status = 'pending';

        $chronology->save();

        return redirect()->route('chronology.index')->with('success', 'dokumen berhasil diupload');
    }
}