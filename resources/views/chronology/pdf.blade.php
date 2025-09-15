<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BAK - {{ $chronology->no }}</title>
    @if (!empty($isPdf))
        <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    @endif
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

    @if (!empty($isPdf))
        {{-- Layout versi PDF: pakai tabel agar stabil --}}
        <table style="width: 100%; border-collapse: collapse; font-size: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                    <h3 class="section-title" style="font-size:11px;">Matrix Otorisasi</h3>
                    <table class="matrix-table" style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th rowspan="2">Nominal</th>
                                <th rowspan="2">Operation Manager</th>
                                <th rowspan="2">Branch Manager</th>
                                <th colspan="3">HO</th>
                            </tr>
                            <tr>
                                <th>Head of Division</th>
                                <th>Finance Director</th>
                                <th>Managing Director</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 5.5px;">Rp. 1 - <br>Rp. 29.999.999</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td style="font-size: 5.5px;">Rp. 30.000.000 -<br> Rp. 99.999.999</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-size: 5.5px;">> Rp. 100.000.000</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                            </tr>
                            <tr>
                                <td style="font-size: 5.5px;">Pengajuan Khusus diluar Surkom</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                                <td class="chcek">✔</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                    @if (!empty($chronology->solutions))
                        <h3 class="section-title" style="font-size: 11px;">Diisi Oleh Operation Manager</h3>
                        <ol class="content" style="font-size: 9px;">
                            @foreach ($chronology->solutions as $solusi)
                                <li>{{ $solusi }}</li>
                            @endforeach
                        </ol>
                    @endif
                </td>
            </tr>
        </table>
    @else
        {{-- Layout versi browser: pakai div dan CSS modern --}}
        <div class="two-column-grid">
            <div class="column-left">
                <h3 class="section-title">Matrix Otorisasi</h3>
                <table class="matrix-table" style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th rowspan="2">Nominal</th>
                            <th rowspan="2">Operation Manager</th>
                            <th rowspan="2">Branch Manager</th>
                            <th colspan="3">HO</th>
                        </tr>
                        <tr>
                            <th>Head of Division</th>
                            <th>Finance Director</th>
                            <th>Managing Director</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rp. 1 - Rp. 29.999.999</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                            <td>Rp. 30.000.000 - Rp. 99.999.999</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>> Rp. 100.000.000</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                        </tr>
                        <tr>
                            <td>Pengajuan Khusus diluar Surkom</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                            <td class="chcek">✔</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column-right">
                @if (!empty($chronology->solutions))
                    <h3 class="section-title">Diisi Oleh Operation Manager</h3>
                    <ol class="content">
                        @foreach ($chronology->solutions as $solusi)
                            <li>{{ $solusi }}</li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    @endif

    @if(empty($isPdf))
        <div style="text-align: right; margin-top: 15px;">
            <a href="{{ route('chronology.download', $chronology->uuid) }}"
            style="background:#2563eb; color:white; padding:6px 12px; border-radius:4px; text-decoration:none; font-weight:bold;">
                Download
            </a>
        </div>
    @endif    
</body>
</html>

