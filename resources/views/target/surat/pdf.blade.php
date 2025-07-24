<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
            margin: 50px;
        }
        .kop {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 30px;
        }
        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }
        .perihal, .tanggal {
            margin-bottom: 10px;
        }
        .isi {
            text-align: justify;
            line-height: 1.5;
        }
        .ttd {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="kop">UNIVERSITAS BALIKPAPAN<br>FAKULTAS TEKNIK</div>

    <div class="nomor">
        Nomor: {{ $data['nourut'] }}/{{$data['kode_instansi']}}/{{ $data['jenis_surat'] }}/{{ $data['bulan'] }}/{{ $data['tahun'] }}
    </div>

    <div class="perihal"><strong>Perihal:</strong> {{ $data['perihal'] }}</div>
    <div class="tanggal"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('d F Y') }}</div>

    <hr>

    <div class="isi">
        {!! nl2br(e($data['isi'])) !!}
    </div>

    <div class="ttd">
        <p>Hormat Kami,</p>
        <br><br>
        <p><strong>Ketua Program Studi</strong></p>
    </div>

</body>
</html>
