<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Kelulusan - {{ $applicant->full_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Outfit',sans-serif;background:#fff;color:#222;padding:40px}
        .container{max-width:700px;margin:0 auto;border:3px solid #34556F;padding:50px;position:relative}
        .container::before{content:'';position:absolute;top:8px;left:8px;right:8px;bottom:8px;border:1px solid #7AAACC;pointer-events:none}
        .header{text-align:center;margin-bottom:30px;border-bottom:2px solid #34556F;padding-bottom:20px}
        .header h1{font-size:14px;letter-spacing:3px;color:#34556F;margin-bottom:5px}
        .header h2{font-size:22px;font-weight:700;color:#34556F}
        .header .nomor{font-size:12px;color:#666;margin-top:5px}
        .title{text-align:center;margin:25px 0;font-size:20px;font-weight:700;color:#34556F;text-decoration:underline;text-underline-offset:5px}
        .body-text{font-size:14px;line-height:1.8;text-align:justify;margin-bottom:20px}
        .data-table{width:100%;margin:20px 0;font-size:14px}
        .data-table td{padding:4px 10px;vertical-align:top}
        .data-table td:first-child{width:180px;color:#555}
        .data-table td:nth-child(2){width:15px}
        .data-table td:last-child{font-weight:600}
        .footer{margin-top:40px;display:flex;justify-content:space-between}
        .footer .left,.footer .right{text-align:center;font-size:13px}
        .footer .right{margin-top:0}
        .sign-space{height:70px}
        .stamp{font-weight:700;text-decoration:underline}
        @media print{body{padding:20px}.no-print{display:none !important}}
        .print-btn{display:block;width:200px;margin:30px auto 0;padding:12px;background:#34556F;color:#fff;border:none;border-radius:12px;font-family:'Outfit';font-weight:700;font-size:14px;cursor:pointer}
        .print-btn:hover{background:#7AAACC}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>SMA UNGGULAN AFINY PALEMBANG</h1>
        <h2>SURAT KETERANGAN KELULUSAN</h2>
        <p class="nomor">Nomor: {{ $applicant->nomor_surat_kelulusan ?? '-' }}</p>
    </div>
    <p class="title">SURAT KETERANGAN LULUS SELEKSI PPDB</p>
    <p class="body-text">Yang bertanda tangan di bawah ini, Panitia Penerimaan Peserta Didik Baru (PPDB) SMA Unggulan AFINY Palembang Tahun Ajaran 2026/2027, dengan ini menerangkan bahwa:</p>
    <table class="data-table">
        <tr><td>Nama Lengkap</td><td>:</td><td>{{ $applicant->full_name }}</td></tr>
        <tr><td>NISN</td><td>:</td><td>{{ $applicant->nisn }}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{{ $applicant->nik }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $applicant->birth_place }}, {{ $applicant->birth_date->format('d F Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $applicant->gender==='L'?'Laki-laki':'Perempuan' }}</td></tr>
        <tr><td>Asal Sekolah</td><td>:</td><td>{{ $applicant->previous_school }}</td></tr>
        <tr><td>Jalur Pendaftaran</td><td>:</td><td>{{ ucfirst($applicant->jalur_pendaftaran) }}</td></tr>
        <tr><td>Jurusan</td><td>:</td><td>{{ $applicant->jurusan_pilihan }}</td></tr>
        @if($applicant->nomor_registrasi)
        <tr><td>Nomor Registrasi</td><td>:</td><td>{{ $applicant->nomor_registrasi }}</td></tr>
        @endif
    </table>
    <p class="body-text">Telah dinyatakan <strong>LULUS</strong> seleksi Penerimaan Peserta Didik Baru (PPDB) dan diterima sebagai siswa SMA Unggulan AFINY Palembang Tahun Ajaran 2026/2027.</p>
    <p class="body-text">Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
    <div style="display:flex;justify-content:flex-end;margin-top:40px">
        <div style="text-align:center;font-size:13px">
            <p>Palembang, {{ now()->format('d F Y') }}</p>
            <p>Panitia PPDB</p>
            <div class="sign-space"></div>
            <p class="stamp">Kepala Sekolah</p>
            <p>SMA Unggulan AFINY Palembang</p>
        </div>
    </div>
</div>
<button class="print-btn no-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</body>
</html>
