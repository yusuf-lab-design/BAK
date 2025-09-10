<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BAK - {{ $chronology->no }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { background: #1e3a8a; color: white; text-align: center; font-weight: bold; padding: 6px; }
        .box { border: 1px solid black; padding: 6px; margin-bottom: 2px; }
        .section-title { background: #1e3a8a; color: white; text-align: center; font-weight: bold; padding: 4px; }
        .content { border: 1px solid #ccc; padding: 8px; margin-bottom: 4px;}
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 2px 4px; }
    </style>
</head>
<body>
    <h2 class="header">BERITA ACARA KRONOLOGIS</h2>

    <div class="box">
        <div style="text-align: center; font-weight: bold; margin-bottom:4px;">
            Nomor : {{ $chronology->no }}
        </div>
        <table>
            <tr>
                <td><strong>Area :</strong> {{ $chronology->area }}</td>
                <td style="text-align: right;"><strong>Tgl. Pengajuan :</strong> {{ $chronology->created_at->format('d-m-Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="box">
        <p><strong>Subject : </strong>{{ is_array($chronology->subject) ? implode(', ', $chronology->subject) : $chronology->subject }}</p>
    </div>

    <h3 class="section-title">KRONOLOGIS</h3>
    <div class="content">
        {!! nl2br(e($chronology->kronologis)) !!}
    </div>

    @if(!empty($isPdf))
        <img src="{{ public_path('images/tandatangan.png') }}" 
            style="border:1px solid black; width:100%; height:auto;" alt="Logo">
    @else
        <img src="{{ asset('images/tandatangan.png') }}" 
            style="border:1px solid black; width:100%; height:auto;" alt="Logo">
    @endif

    @if (!empty($chronology->solutions))
    <h3 class="section-title">Diisi Oleh Operation Manager</h3>
    <ol class="content">
        @foreach ($chronology->solutions ?? [] as $solusi)
        <li>{{ $solusi }}</li>
        @endforeach
    </ol>
    @endif

    @if(empty($isPdf))
        <div style="text-align: right; margin-top: 15px;">
            <a href="{{ route('chronology.download', $chronology->uuid) }}"
            style="background:#2563eb; color:white; padding:6px 12px; border-radius:4px; text-decoration:none; font-weight:bold;">
                Download PDF
            </a>
        </div>
    @endif    
</body>
</html>
