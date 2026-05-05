<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftar | Admin SPARTA</title>
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
    <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-theme-dark flex items-center justify-center text-theme-light font-bold">A</div>
            <span class="font-bold text-theme-dark">Detail Pendaftar</span>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-theme-dark/60 hover:text-theme-green transition">
            <span class="material-symbols-outlined" style="font-size:18px">arrow_back</span>Kembali
        </a>
    </div>
</nav>

<main class="max-w-6xl mx-auto px-4 py-8">
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-2">
    <span class="material-symbols-outlined icon-filled text-green-600">check_circle</span>{{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Kolom Kiri: Foto + Keputusan --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-4 py-3 border-b text-xs font-bold text-theme-dark/50 uppercase flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:14px">photo_camera</span>Pas Foto
            </div>
            <div class="p-4">
                @if($applicant->pas_foto)
                    @php
                        $ext = strtolower(pathinfo($applicant->pas_foto, PATHINFO_EXTENSION));
                    @endphp
                    @if($ext === 'pdf')
                        <a href="{{ asset('storage/'.$applicant->pas_foto) }}" target="_blank" class="py-12 flex flex-col items-center gap-2 text-theme-green">
                            <span class="material-symbols-outlined icon-filled" style="font-size:48px">description</span>
                            <p class="text-sm font-bold">Buka Foto (PDF)</p>
                        </a>
                    @else
                        <img src="{{ asset('storage/'.$applicant->pas_foto) }}" class="w-full rounded-xl object-cover" onerror="this.src='https://placehold.co/400x500?text=Error+Loading+Image';">
                    @endif
                @else
                    <div class="py-12 flex flex-col items-center gap-2 text-slate-400">
                        <span class="material-symbols-outlined" style="font-size:40px">hide_image</span>
                        <p class="text-sm">Tidak ada foto</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Form Keputusan --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-4 py-3 border-b text-xs font-bold text-theme-dark/50 uppercase flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:14px">gavel</span>Keputusan Admin
            </div>
            <form action="{{ route('admin.applicant.status', $applicant) }}" method="POST" class="p-4 space-y-4">
                @csrf @method('PATCH')

                <div>
                    <label class="block text-sm font-semibold mb-2">Step 1: Verifikasi</label>
                    <select id="verifySelect" onchange="handleVerify()" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm font-bold">
                        <option value="pending" {{ $applicant->status==='pending'?'selected':'' }}>Pending (Belum Diverifikasi)</option>
                        <option value="verified" {{ in_array($applicant->status,['accepted','rejected'])?'selected':'' }}>Verified (Sudah Ditinjau)</option>
                    </select>
                </div>

                <div id="decisionSection" class="{{ in_array($applicant->status,['accepted','rejected'])?'':'hidden' }}">
                    <label class="block text-sm font-semibold mb-2">Step 2: Keputusan</label>
                    <select name="status" id="statusSelect" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm font-bold">
                        <option value="accepted" {{ $applicant->status==='accepted'?'selected':'' }}>Terima</option>
                        <option value="rejected" {{ $applicant->status==='rejected'?'selected':'' }}>Tolak</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Catatan untuk Siswa</label>
                    <textarea name="admin_notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="Alasan, pesan...">{{ $applicant->admin_notes }}</textarea>
                </div>

                <div id="acceptedFields" class="{{ $applicant->status==='accepted'?'':'hidden' }} space-y-3 border-t border-slate-100 pt-4">
                    <p class="text-xs font-bold text-theme-dark/50 uppercase flex items-center gap-1">
                        <span class="material-symbols-outlined" style="font-size:14px">info</span>Info Pasca-Kelulusan
                    </p>
                    <div><label class="block text-xs font-semibold mb-1">No. Registrasi</label><input type="text" name="nomor_registrasi" value="{{ $applicant->nomor_registrasi }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm" placeholder="Auto-generate jika kosong"></div>
                    <div><label class="block text-xs font-semibold mb-1">Biaya Daftar Ulang (Rp)</label><input type="number" name="biaya_pendaftaran" value="{{ $applicant->biaya_pendaftaran }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm" placeholder="0"></div>
                    <div><label class="block text-xs font-semibold mb-1">Info Daftar Ulang</label><textarea name="info_daftar_ulang" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm">{{ $applicant->info_daftar_ulang }}</textarea></div>
                    <div><label class="block text-xs font-semibold mb-1">Jadwal Daftar Ulang</label><input type="date" name="jadwal_daftar_ulang" value="{{ $applicant->jadwal_daftar_ulang?->format('Y-m-d') }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Jadwal MPLS</label><input type="date" name="jadwal_mpls" value="{{ $applicant->jadwal_mpls?->format('Y-m-d') }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm"></div>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-theme-dark text-theme-light font-bold hover:bg-theme-green transition shadow-md flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:18px">save</span>Simpan Keputusan
                </button>
            </form>
        </div>

        {{-- Payment Verification --}}
        @if($applicant->status==='accepted' && $applicant->bukti_pembayaran)
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-4 py-3 border-b text-xs font-bold text-theme-dark/50 uppercase flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:14px">payments</span>Verifikasi Pembayaran
            </div>
            <div class="p-4">
                <a href="{{ asset('storage/'.$applicant->bukti_pembayaran) }}" target="_blank" class="block mb-3">
                    @php
                        $ext = strtolower(pathinfo($applicant->bukti_pembayaran, PATHINFO_EXTENSION));
                    @endphp
                    @if($ext === 'pdf')
                    <p class="text-center py-4 text-theme-green font-bold flex items-center justify-center gap-2 border-2 border-dashed border-theme-green/20 rounded-xl">
                        <span class="material-symbols-outlined icon-filled">description</span>Buka Bukti Bayar (PDF)
                    </p>
                    @else
                    <img src="{{ asset('storage/'.$applicant->bukti_pembayaran) }}" class="w-full rounded-xl shadow-sm" onerror="this.src='https://placehold.co/400x300?text=Error+Loading+File';">
                    @endif
                </a>
                <form action="{{ route('admin.applicant.payment', $applicant) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status_pembayaran" class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-sm font-bold mb-3">
                        <option value="menunggu_verifikasi" {{ $applicant->status_pembayaran==='menunggu_verifikasi'?'selected':'' }}>Menunggu Verifikasi</option>
                        <option value="lunas" {{ $applicant->status_pembayaran==='lunas'?'selected':'' }}>Lunas</option>
                        <option value="belum_bayar" {{ $applicant->status_pembayaran==='belum_bayar'?'selected':'' }}>Belum Bayar</option>
                    </select>
                    <button type="submit" class="w-full py-2 rounded-lg bg-green-600 text-white font-bold text-sm hover:bg-green-700 transition flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" style="font-size:16px">verified</span>Update Pembayaran
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>

    {{-- Kolom Kanan: Data Lengkap --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Status --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 p-5 flex justify-between items-center">
            <div>
                <p class="text-xs text-theme-dark/50 font-semibold mb-1">Status</p>
                @if($applicant->status==='pending')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm">
                        <span class="material-symbols-outlined" style="font-size:16px">hourglass_empty</span>Pending
                    </span>
                @elseif($applicant->status==='accepted')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold text-sm">
                        <span class="material-symbols-outlined icon-filled text-green-600" style="font-size:16px">check_circle</span>Diterima
                    </span>
                @elseif($applicant->status==='rejected')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-800 font-bold text-sm">
                        <span class="material-symbols-outlined icon-filled text-red-500" style="font-size:16px">cancel</span>Ditolak
                    </span>
                @endif
            </div>
            <p class="text-xs text-theme-dark/40">Terdaftar: {{ $applicant->created_at->format('d M Y, H:i') }}</p>
        </div>

        {{-- Data Pribadi --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-5 py-3 border-b font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-theme-dark/50" style="font-size:18px">person</span>Data Pribadi
            </div>
            <div class="p-5 grid grid-cols-2 gap-4 text-sm">
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Nama</p><p class="font-bold">{{ $applicant->full_name }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">NISN</p><p class="font-bold">{{ $applicant->nisn }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">NIK</p><p class="font-bold">{{ $applicant->nik }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Jenis Kelamin</p><p class="font-bold">{{ $applicant->gender==='L'?'Laki-laki':'Perempuan' }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Agama</p><p class="font-bold">{{ $applicant->agama }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">TTL</p><p class="font-bold">{{ $applicant->birth_place }}, {{ $applicant->birth_date->format('d/m/Y') }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">HP Siswa</p><p class="font-bold">{{ $applicant->phone_number }}</p></div>
                <div class="col-span-2"><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Alamat</p><p class="font-bold">{{ $applicant->address }}</p></div>
            </div>
        </div>

        {{-- Data Orang Tua --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-5 py-3 border-b font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-theme-dark/50" style="font-size:18px">family_restroom</span>Data Orang Tua
            </div>
            <div class="p-5 grid grid-cols-2 gap-4 text-sm">
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Nama Ayah</p><p class="font-bold">{{ $applicant->nama_ayah }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Nama Ibu</p><p class="font-bold">{{ $applicant->nama_ibu }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Pekerjaan</p><p class="font-bold">{{ $applicant->pekerjaan_ortu }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">HP Ortu</p><p class="font-bold">{{ $applicant->hp_ortu }}</p></div>
                @if($applicant->alamat_ortu)<div class="col-span-2"><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Alamat Ortu</p><p class="font-bold">{{ $applicant->alamat_ortu }}</p></div>@endif
            </div>
        </div>

        {{-- Data Sekolah & Jalur --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-5 py-3 border-b font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-theme-dark/50" style="font-size:18px">school</span>Sekolah Asal & Jalur
            </div>
            <div class="p-5 grid grid-cols-2 gap-4 text-sm">
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Sekolah Asal</p><p class="font-bold">{{ $applicant->previous_school }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Tahun Lulus</p><p class="font-bold">{{ $applicant->tahun_lulus }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Jalur</p><p class="font-bold uppercase">{{ $applicant->jalur_pendaftaran }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Jurusan</p><p class="font-bold">{{ $applicant->jurusan_pilihan }}</p></div>
                @if($applicant->jalur_pendaftaran==='rapor')
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Nilai Sem 5</p><p class="font-bold">{{ $applicant->nilai_rapor_sem5 ?? '-' }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Nilai Sem 6</p><p class="font-bold">{{ $applicant->nilai_rapor_sem6 ?? '-' }}</p></div>
                @elseif($applicant->jalur_pendaftaran==='zonasi')
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Jarak (km)</p><p class="font-bold">{{ $applicant->jarak_rumah_km ?? '-' }}</p></div>
                <div><p class="text-xs text-theme-dark/50 font-semibold uppercase mb-1">Alamat Zonasi</p><p class="font-bold">{{ $applicant->alamat_rumah_zonasi ?? '-' }}</p></div>
                @endif
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="bg-white rounded-2xl shadow-md border border-theme-green/10 overflow-hidden">
            <div class="bg-slate-50 px-5 py-3 border-b font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-theme-dark/50" style="font-size:18px">folder_open</span>Dokumen Upload
            </div>
            <div class="p-5 grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach(['ijazah_skl'=>'Ijazah/SKL','kartu_keluarga'=>'Kartu Keluarga','akte_kelahiran'=>'Akte Kelahiran','kartu_pelajar'=>'Kartu Pelajar','file_rapor'=>'File Rapor','sertifikat_prestasi'=>'Sertifikat','dokumen_tambahan'=>'Lainnya'] as $f=>$l)
                <div class="border rounded-xl overflow-hidden">
                    <div class="bg-slate-50 px-3 py-1 border-b text-xs font-bold text-theme-dark/50">{{ $l }}</div>
                    <div class="p-3">
                        @if($applicant->$f)
                            @php
                                $ext = strtolower(pathinfo($applicant->$f, PATHINFO_EXTENSION));
                                $isPdf = $ext === 'pdf';
                            @endphp

                            @if($isPdf)
                            <a href="{{ asset('storage/'.$applicant->$f) }}" target="_blank" class="flex flex-col items-center py-4 text-theme-green font-bold hover:text-theme-dark transition gap-1">
                                <span class="material-symbols-outlined icon-filled" style="font-size:32px">description</span>
                                <span class="text-xs">Buka PDF</span>
                            </a>
                            @else
                            <a href="{{ asset('storage/'.$applicant->$f) }}" target="_blank">
                                <img src="{{ asset('storage/'.$applicant->$f) }}" class="w-full h-24 object-cover rounded-lg hover:opacity-90 transition" onerror="this.onerror=null;this.src='https://placehold.co/400x300?text=File+Error';">
                            </a>
                            @endif
                        @else
                        <div class="flex flex-col items-center py-4 text-slate-300 gap-1">
                            <span class="material-symbols-outlined" style="font-size:28px">hide_image</span>
                            <span class="text-xs">—</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</main>

<script>
function handleVerify(){
    const v=document.getElementById('verifySelect').value;
    const ds=document.getElementById('decisionSection');
    const af=document.getElementById('acceptedFields');
    if(v==='verified'){ds.classList.remove('hidden')}
    else{ds.classList.add('hidden');af.classList.add('hidden');document.getElementById('statusSelect').innerHTML='<option value="pending" selected>Pending</option>'}
}
document.getElementById('statusSelect')?.addEventListener('change',function(){
    const af=document.getElementById('acceptedFields');
    if(this.value==='accepted'){af.classList.remove('hidden')}else{af.classList.add('hidden')}
});
</script>
</body>
</html>
