<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan | SPARTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body{font-family:'Outfit',sans-serif}
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;vertical-align:middle;line-height:1}
        .icon-filled{font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24}
    </style>
</head>
<body class="bg-theme-light antialiased text-theme-dark min-h-screen flex flex-col">
<nav class="bg-white border-b border-theme-green/30 shadow-sm">
    <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
        <div class="flex items-center gap-2"><div class="w-8 h-8 rounded-lg bg-theme-dark flex items-center justify-center text-theme-light font-bold">A</div><span class="font-bold text-theme-dark">SPARTA</span></div>
        <a href="{{ route('siswa.dashboard') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-theme-dark/60 hover:text-theme-green transition">
            <span class="material-symbols-outlined" style="font-size:18px">arrow_back</span>Kembali ke Dashboard
        </a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full">
        @if($applicant->status === 'accepted')
        {{-- LULUS --}}
        <div class="bg-green-50 border-2 border-green-300 rounded-3xl p-8 text-center shadow-xl">
            <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined icon-filled text-green-600" style="font-size:48px">celebration</span>
            </div>
            <h1 class="text-3xl font-extrabold text-green-800 mb-2">SELAMAT!</h1>
            <h2 class="text-xl font-bold text-green-700 mb-4">Anda Dinyatakan LULUS</h2>
            <p class="text-green-700/80 mb-6">Penerimaan Peserta Didik Baru (PPDB)<br>SMA Unggulan AFINY Palembang<br>Tahun Ajaran 2026/2027</p>
            <div class="bg-white rounded-2xl p-5 text-left space-y-3 mb-6 border border-green-200">
                <div class="flex justify-between text-sm"><span class="text-green-600">Nama</span><span class="font-bold">{{ $applicant->full_name }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-green-600">NISN</span><span class="font-bold">{{ $applicant->nisn }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-green-600">Asal Sekolah</span><span class="font-bold">{{ $applicant->previous_school }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-green-600">Jurusan</span><span class="font-bold">{{ $applicant->jurusan_pilihan }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-green-600">Jalur</span><span class="font-bold uppercase">{{ $applicant->jalur_pendaftaran }}</span></div>
                @if($applicant->nomor_registrasi)
                <div class="flex justify-between text-sm"><span class="text-green-600">No. Registrasi</span><span class="font-bold">{{ $applicant->nomor_registrasi }}</span></div>
                @endif
                @if($applicant->nomor_surat_kelulusan)
                <div class="flex justify-between text-sm"><span class="text-green-600">No. Surat</span><span class="font-bold">{{ $applicant->nomor_surat_kelulusan }}</span></div>
                @endif
            </div>
            <a href="{{ route('siswa.surat-kelulusan') }}" target="_blank"
               class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg">
                <span class="material-symbols-outlined" style="font-size:20px">print</span>Cetak Surat Kelulusan
            </a>
        </div>
        @else
        {{-- TIDAK LULUS --}}
        <div class="bg-red-50 border-2 border-red-300 rounded-3xl p-8 text-center shadow-xl">
            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined icon-filled text-red-500" style="font-size:48px">sentiment_dissatisfied</span>
            </div>
            <h1 class="text-3xl font-extrabold text-red-800 mb-2">TIDAK LULUS</h1>
            <h2 class="text-lg font-bold text-red-700 mb-4">Mohon Maaf, Anda Belum Diterima</h2>
            <p class="text-red-700/80 mb-6">Penerimaan Peserta Didik Baru (PPDB)<br>SMA Unggulan AFINY Palembang<br>Tahun Ajaran 2026/2027</p>
            <div class="bg-white rounded-2xl p-5 text-left space-y-3 mb-6 border border-red-200">
                <div class="flex justify-between text-sm"><span class="text-red-600">Nama</span><span class="font-bold">{{ $applicant->full_name }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-red-600">NISN</span><span class="font-bold">{{ $applicant->nisn }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-red-600">Asal Sekolah</span><span class="font-bold">{{ $applicant->previous_school }}</span></div>
                @if($applicant->admin_notes)
                <div class="pt-2 border-t border-red-100">
                    <p class="text-xs text-red-500 font-semibold mb-1 flex items-center gap-1">
                        <span class="material-symbols-outlined" style="font-size:14px">info</span>Catatan:
                    </p>
                    <p class="text-sm">{{ $applicant->admin_notes }}</p>
                </div>
                @endif
            </div>
            <p class="text-sm text-red-700/60">Jangan menyerah! Anda dapat mencoba mendaftar di jalur atau gelombang pendaftaran lainnya.</p>
        </div>
        @endif
    </div>
</main>
</body>
</html>
