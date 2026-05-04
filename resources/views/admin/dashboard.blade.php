<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SPARTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body{font-family:'Outfit',sans-serif}
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;vertical-align:middle;line-height:1}
        .icon-filled{font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24}
    </style>
</head>
<body class="bg-theme-light antialiased text-theme-dark min-h-screen">
<nav class="bg-white border-b border-theme-green/30 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-theme-dark flex items-center justify-center text-theme-light font-bold">A</div>
            <span class="font-bold text-lg text-theme-dark">Admin SPARTA</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-theme-dark/60">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="inline-flex items-center gap-1 text-sm font-bold text-red-500 hover:text-red-700 transition">
                    <span class="material-symbols-outlined" style="font-size:16px">logout</span>Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-2">
        <span class="material-symbols-outlined icon-filled text-green-600">check_circle</span>{{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 shadow-md border border-theme-green/10">
            <p class="text-xs font-semibold text-theme-dark/50 mb-1 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">group</span>Total</p>
            <p class="text-3xl font-extrabold">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-md border border-yellow-200">
            <p class="text-xs font-semibold text-yellow-600 mb-1 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">hourglass_empty</span>Pending</p>
            <p class="text-3xl font-extrabold text-yellow-600">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-md border border-blue-200">
            <p class="text-xs font-semibold text-blue-600 mb-1 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">manage_search</span>Diverifikasi</p>
            <p class="text-3xl font-extrabold text-blue-600">{{ $stats['verified'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-md border border-green-200">
            <p class="text-xs font-semibold text-green-600 mb-1 flex items-center gap-1"><span class="material-symbols-outlined icon-filled" style="font-size:14px">check_circle</span>Diterima</p>
            <p class="text-3xl font-extrabold text-green-600">{{ $stats['accepted'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-md border border-red-200">
            <p class="text-xs font-semibold text-red-600 mb-1 flex items-center gap-1"><span class="material-symbols-outlined icon-filled" style="font-size:14px">cancel</span>Ditolak</p>
            <p class="text-3xl font-extrabold text-red-600">{{ $stats['rejected'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-theme-green/10 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-lg font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-theme-dark/50" style="font-size:20px">list_alt</span>Daftar Calon Siswa
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Foto</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Nama / NISN</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Asal Sekolah</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Jalur</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Jurusan</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Bayar</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applicants as $a)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            @if($a->pas_foto)
                                <img src="{{ asset('storage/'.$a->pas_foto) }}" class="w-10 h-10 rounded-lg object-cover border">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-400" style="font-size:18px">person</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3"><p class="font-bold text-sm">{{ $a->full_name }}</p><p class="text-xs text-theme-dark/50">{{ $a->nisn }}</p></td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $a->previous_school }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-bold uppercase px-2 py-1 rounded bg-theme-light flex items-center gap-1 w-fit">
                                <span class="material-symbols-outlined" style="font-size:12px">{{ $a->jalur_pendaftaran==='zonasi' ? 'location_on' : 'bar_chart' }}</span>
                                {{ $a->jalur_pendaftaran ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $a->jurusan_pilihan ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($a->status==='pending')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold">
                                    <span class="material-symbols-outlined" style="font-size:12px">hourglass_empty</span>Pending
                                </span>
                            @elseif($a->status==='accepted')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold">
                                    <span class="material-symbols-outlined icon-filled" style="font-size:12px">check_circle</span>Diterima
                                </span>
                            @elseif($a->status==='rejected')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold">
                                    <span class="material-symbols-outlined icon-filled" style="font-size:12px">cancel</span>Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($a->status==='accepted')
                                @if($a->status_pembayaran==='lunas')
                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-green-600">
                                        <span class="material-symbols-outlined icon-filled" style="font-size:14px">check_circle</span>Lunas
                                    </span>
                                @elseif($a->status_pembayaran==='menunggu_verifikasi')
                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-yellow-600">
                                        <span class="material-symbols-outlined" style="font-size:14px">hourglass_empty</span>Cek
                                    </span>
                                @else<span class="text-xs text-slate-400">—</span>@endif
                            @else<span class="text-xs text-slate-400">—</span>@endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.applicant.show', $a) }}" class="inline-flex items-center gap-1 px-4 py-2 rounded-lg bg-theme-dark text-theme-light text-xs font-bold hover:bg-theme-green transition">
                                <span class="material-symbols-outlined" style="font-size:14px">visibility</span>Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-4 py-12 text-center text-slate-400">
                        <span class="material-symbols-outlined block mx-auto mb-2" style="font-size:40px">inbox</span>
                        Belum ada pendaftar.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
