<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | SPARTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body{font-family:'Outfit',sans-serif}
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;vertical-align:middle;font-size:20px;line-height:1}
        .icon-filled{font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24}
    </style>
</head>
<body class="bg-theme-light antialiased text-theme-dark min-h-screen">
<nav class="bg-white border-b border-theme-green/30 shadow-sm sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-theme-dark flex items-center justify-center text-theme-light font-bold">A</div>
            <span class="font-bold text-lg text-theme-dark">Dashboard Siswa</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-theme-dark/60">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 transition">Logout</button></form>
        </div>
    </div>
</nav>

<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-2">
        <span class="material-symbols-outlined icon-filled text-green-600">check_circle</span>{{ session('success') }}
    </div>
    @endif

    @if($applicant)
    {{-- Status Card --}}
    <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 p-6 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <p class="text-xs text-theme-dark/50 font-semibold uppercase mb-2">Status Pendaftaran</p>
            @if($applicant->status==='pending')
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm">
                <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span>Menunggu Verifikasi
            </span>
            @else
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold text-sm">
                <span class="material-symbols-outlined icon-filled text-green-600" style="font-size:18px">notifications_active</span>Hasil Seleksi Tersedia
            </span>
            @endif
        </div>
        @if(in_array($applicant->status, ['accepted','rejected']))
        <a href="{{ route('siswa.kelulusan') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl {{ $applicant->status==='accepted' ? 'bg-green-600 hover:bg-green-700' : 'bg-theme-dark hover:bg-theme-green' }} text-white font-bold text-sm transition shadow-md">
            <span class="material-symbols-outlined" style="font-size:18px">assignment</span>Cek Kelulusan
        </a>
        @endif
    </div>

    @if($applicant->admin_notes)
    <div class="bg-white rounded-2xl border border-theme-green/10 p-5 mb-6 shadow-sm">
        <p class="text-xs text-theme-dark/50 font-semibold mb-1 flex items-center gap-1">
            <span class="material-symbols-outlined" style="font-size:16px">sticky_note_2</span>Catatan dari Admin:
        </p>
        <p class="text-sm font-medium">{{ $applicant->admin_notes }}</p>
    </div>
    @endif

    {{-- Data Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 p-6">
            <h3 class="font-bold mb-4 text-theme-dark border-b pb-2 flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-size:18px">person</span>Data Pribadi
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-theme-dark/50">Nama</span><span class="font-bold">{{ $applicant->full_name }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">NISN</span><span class="font-bold">{{ $applicant->nisn }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">NIK</span><span class="font-bold">{{ $applicant->nik }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">Jenis Kelamin</span><span class="font-bold">{{ $applicant->gender==='L'?'Laki-laki':'Perempuan' }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">TTL</span><span class="font-bold">{{ $applicant->birth_place }}, {{ $applicant->birth_date->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">Jalur</span><span class="font-bold uppercase">{{ $applicant->jalur_pendaftaran }}</span></div>
                <div class="flex justify-between"><span class="text-theme-dark/50">Jurusan</span><span class="font-bold">{{ $applicant->jurusan_pilihan }}</span></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 p-6">
            <h3 class="font-bold mb-4 text-theme-dark border-b pb-2 flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-size:18px">folder_open</span>Dokumen Diunggah
            </h3>
            <div class="space-y-2 text-sm">
                @foreach(['pas_foto'=>'Pas Foto','ijazah_skl'=>'Ijazah/SKL','kartu_keluarga'=>'Kartu Keluarga','akte_kelahiran'=>'Akte Kelahiran','kartu_pelajar'=>'Kartu Pelajar','sertifikat_prestasi'=>'Sertifikat'] as $f=>$l)
                <div class="flex justify-between items-center">
                    <span class="text-theme-dark/50">{{ $l }}</span>
                    @if($applicant->$f)
                    <a href="{{ asset('storage/'.$applicant->$f) }}" target="_blank" class="text-theme-green font-bold hover:underline text-xs flex items-center gap-1">
                        <span class="material-symbols-outlined icon-filled" style="font-size:14px">check_circle</span>Lihat
                    </a>
                    @else<span class="text-slate-400 text-xs">—</span>@endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ACCEPTED: Info Daftar Ulang & Pembayaran --}}
    @if($applicant->status==='accepted')
    <div class="bg-white rounded-2xl shadow-xl border border-green-200 overflow-hidden mb-6">
        <div class="bg-green-50 px-6 py-4 border-b border-green-200">
            <h3 class="font-bold text-green-800 flex items-center gap-2">
                <span class="material-symbols-outlined icon-filled text-green-600">task_alt</span>Informasi Pasca-Kelulusan
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @if($applicant->nomor_registrasi)
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-green-600 font-semibold mb-1 flex items-center justify-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">badge</span>Nomor Registrasi</p>
                    <p class="text-xl font-extrabold text-green-800">{{ $applicant->nomor_registrasi }}</p>
                </div>
                @endif
                @if($applicant->jadwal_daftar_ulang)
                <div class="bg-theme-light rounded-xl p-4 text-center">
                    <p class="text-xs text-theme-dark/50 font-semibold mb-1 flex items-center justify-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">calendar_month</span>Jadwal Daftar Ulang</p>
                    <p class="font-bold">{{ $applicant->jadwal_daftar_ulang->format('d M Y') }}</p>
                </div>
                @endif
                @if($applicant->jadwal_mpls)
                <div class="bg-theme-light rounded-xl p-4 text-center">
                    <p class="text-xs text-theme-dark/50 font-semibold mb-1 flex items-center justify-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">school</span>Jadwal MPLS</p>
                    <p class="font-bold">{{ $applicant->jadwal_mpls->format('d M Y') }}</p>
                </div>
                @endif
            </div>

            @if($applicant->info_daftar_ulang)
            <div class="bg-theme-light rounded-xl p-4 mb-6">
                <p class="text-xs font-semibold text-theme-dark/50 mb-1">Info Daftar Ulang:</p>
                <p class="text-sm">{{ $applicant->info_daftar_ulang }}</p>
            </div>
            @endif

            @if($applicant->biaya_pendaftaran)
            <div class="border border-slate-200 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-sm font-semibold text-theme-dark/50">Biaya Daftar Ulang</p>
                        <p class="text-2xl font-extrabold">Rp {{ number_format($applicant->biaya_pendaftaran,0,',','.') }}</p>
                    </div>
                    <div>
                        @if($applicant->status_pembayaran==='lunas')
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold text-xs">
                            <span class="material-symbols-outlined icon-filled" style="font-size:14px">check_circle</span>Lunas
                        </span>
                        @elseif($applicant->status_pembayaran==='menunggu_verifikasi')
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold text-xs">
                            <span class="material-symbols-outlined" style="font-size:14px">hourglass_empty</span>Menunggu Verifikasi
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full bg-red-100 text-red-800 font-bold text-xs">
                            <span class="material-symbols-outlined" style="font-size:14px">cancel</span>Belum Bayar
                        </span>
                        @endif
                    </div>
                </div>
                @if($applicant->status_pembayaran!=='lunas')
                <form action="{{ route('siswa.upload-pembayaran') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required class="flex-1 text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-xl bg-theme-dark text-theme-light font-bold text-sm hover:bg-theme-green transition">
                        <span class="material-symbols-outlined" style="font-size:16px">upload_file</span>Upload Bukti
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endif

    @else
    {{-- Belum mendaftar --}}
    <div class="bg-white rounded-3xl shadow-xl border border-theme-green/10 p-10 text-center">
        <div class="w-20 h-20 rounded-full bg-theme-green/10 flex items-center justify-center mx-auto mb-6">
            <span class="material-symbols-outlined text-theme-dark/40" style="font-size:42px">edit_note</span>
        </div>
        <h2 class="text-2xl font-bold mb-2">Anda Belum Melakukan Pendaftaran</h2>
        <p class="text-theme-dark/60 mb-8 max-w-md mx-auto">Lengkapi formulir pendaftaran PPDB SMA Unggulan AFINY Palembang sekarang.</p>
        <a href="{{ route('siswa.daftar') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-theme-dark text-theme-light font-bold text-lg hover:bg-theme-green transition shadow-lg">
            <span class="material-symbols-outlined">assignment_add</span>Isi Formulir Pendaftaran
        </a>
    </div>
    @endif
</main>
</body>
</html>
