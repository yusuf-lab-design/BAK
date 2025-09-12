<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BAK - {{ $chronology->no }}</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
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

    <div class="two-column-grid ">
        <div class="column-left">
            <h3 class="section-title">Matrix Otorisasi</h3>
            <table class="matrix-table">
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
