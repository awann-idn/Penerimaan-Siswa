<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir PPDB | SPARTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body{font-family:'Outfit',sans-serif}.step{display:none}.step.active{display:block}</style>
</head>
<body class="bg-theme-light antialiased text-theme-dark min-h-screen">
<nav class="bg-white border-b border-theme-green/30 shadow-sm sticky top-0 z-50">
    <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2"><div class="w-8 h-8 rounded-lg bg-theme-dark flex items-center justify-center text-theme-light font-bold">A</div><span class="font-bold text-theme-dark">SPARTA</span></a>
        <a href="{{ route('siswa.dashboard') }}" class="text-sm font-semibold text-theme-dark/60 hover:text-theme-green transition">← Dashboard</a>
    </div>
</nav>
<main class="py-8 px-4">
<div class="max-w-3xl mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold mb-2">Formulir Pendaftaran PPDB</h1>
        <p class="text-theme-dark/60 text-sm">SMA Unggulan AFINY Palembang — Tahun Ajaran 2026/2027</p>
    </div>
    <!-- Progress Bar -->
    <div class="mb-8 bg-white rounded-2xl p-4 shadow border border-theme-green/10">
        <div class="flex justify-between text-xs font-bold mb-2">
            <span id="stepLabel">Step 1 dari 5</span>
            <span id="stepPercent">20%</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2"><div id="progressBar" class="bg-theme-dark h-2 rounded-full transition-all duration-500" style="width:20%"></div></div>
        <div class="flex justify-between mt-2 text-xs text-theme-dark/50">
            <span>Data Pribadi</span><span>Orang Tua</span><span>Sekolah & Jalur</span><span>Dokumen</span><span>Konfirmasi</span>
        </div>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl text-sm">
        <h3 class="font-bold text-red-800 mb-1">Terdapat kesalahan:</h3>
        <ul class="text-red-700 list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
    </div>
    @endif

    <form id="mainForm" action="{{ route('siswa.daftar.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-xl border border-theme-green/10 overflow-hidden">
    @csrf

    <!-- STEP 1: Data Pribadi -->
    <div class="step active p-8" data-step="1">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-theme-dark text-theme-light flex items-center justify-center text-sm">1</span>Data Pribadi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2"><label class="block text-sm font-semibold mb-1">Nama Lengkap <span class="text-red-500">*</span></label><input type="text" name="full_name" value="{{old('full_name')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green focus:border-theme-green transition text-sm" placeholder="Sesuai akta kelahiran"></div>
            <div><label class="block text-sm font-semibold mb-1">NISN <span class="text-red-500">*</span></label><input type="text" name="nisn" value="{{old('nisn')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green focus:border-theme-green transition text-sm" placeholder="10 digit"></div>
            <div><label class="block text-sm font-semibold mb-1">NIK <span class="text-red-500">*</span></label><input type="text" name="nik" value="{{old('nik')}}" required maxlength="16" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green focus:border-theme-green transition text-sm" placeholder="16 digit"></div>
            <div><label class="block text-sm font-semibold mb-1">Jenis Kelamin <span class="text-red-500">*</span></label><select name="gender" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"><option value="">Pilih</option><option value="L" {{old('gender')=='L'?'selected':''}}>Laki-laki</option><option value="P" {{old('gender')=='P'?'selected':''}}>Perempuan</option></select></div>
            <div><label class="block text-sm font-semibold mb-1">Agama <span class="text-red-500">*</span></label><select name="agama" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"><option value="">Pilih</option>@foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)<option value="{{$a}}" {{old('agama')==$a?'selected':''}}>{{$a}}</option>@endforeach</select></div>
            <div><label class="block text-sm font-semibold mb-1">Tempat Lahir <span class="text-red-500">*</span></label><input type="text" name="birth_place" value="{{old('birth_place')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="Cth: Palembang"></div>
            <div><label class="block text-sm font-semibold mb-1">Tanggal Lahir <span class="text-red-500">*</span></label><input type="date" name="birth_date" value="{{old('birth_date')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"></div>
            <div><label class="block text-sm font-semibold mb-1">No. HP Siswa <span class="text-red-500">*</span></label><input type="text" name="phone_number" value="{{old('phone_number')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="08xxx"></div>
            <div class="md:col-span-2"><label class="block text-sm font-semibold mb-1">Alamat Lengkap Siswa <span class="text-red-500">*</span></label><textarea name="address" rows="2" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="RT/RW, Kelurahan, Kecamatan...">{{old('address')}}</textarea></div>
        </div>
    </div>

    <!-- STEP 2: Data Orang Tua -->
    <div class="step p-8" data-step="2">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-theme-dark text-theme-light flex items-center justify-center text-sm">2</span>Data Orang Tua / Wali</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div><label class="block text-sm font-semibold mb-1">Nama Ayah <span class="text-red-500">*</span></label><input type="text" name="nama_ayah" value="{{old('nama_ayah')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"></div>
            <div><label class="block text-sm font-semibold mb-1">Nama Ibu <span class="text-red-500">*</span></label><input type="text" name="nama_ibu" value="{{old('nama_ibu')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"></div>
            <div><label class="block text-sm font-semibold mb-1">Pekerjaan Orang Tua <span class="text-red-500">*</span></label><input type="text" name="pekerjaan_ortu" value="{{old('pekerjaan_ortu')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"></div>
            <div><label class="block text-sm font-semibold mb-1">No. HP Orang Tua <span class="text-red-500">*</span></label><input type="text" name="hp_ortu" value="{{old('hp_ortu')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="08xxx"></div>
            <div class="md:col-span-2"><label class="block text-sm font-semibold mb-1">Alamat Orang Tua <span class="text-theme-dark/40">(kosongkan jika sama dengan siswa)</span></label><textarea name="alamat_ortu" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm">{{old('alamat_ortu')}}</textarea></div>
        </div>
    </div>

    <!-- STEP 3: Sekolah Asal & Jalur -->
    <div class="step p-8" data-step="3">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-theme-dark text-theme-light flex items-center justify-center text-sm">3</span>Sekolah Asal & Jalur Pendaftaran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <div class="md:col-span-2"><label class="block text-sm font-semibold mb-1">Nama Sekolah Asal <span class="text-red-500">*</span></label><input type="text" name="previous_school" value="{{old('previous_school')}}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="Cth: SMPN 1 Palembang"></div>
            <div class="md:col-span-2"><label class="block text-sm font-semibold mb-1">Alamat Sekolah Asal <span class="text-red-500">*</span></label><textarea name="alamat_sekolah_asal" rows="2" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm">{{old('alamat_sekolah_asal')}}</textarea></div>
            <div><label class="block text-sm font-semibold mb-1">Tahun Lulus <span class="text-red-500">*</span></label><input type="text" name="tahun_lulus" value="{{old('tahun_lulus')}}" required maxlength="4" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="2026"></div>
            <div><label class="block text-sm font-semibold mb-1">Jurusan Pilihan <span class="text-red-500">*</span></label><select name="jurusan_pilihan" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-theme-green transition text-sm"><option value="">Pilih Jurusan</option><option value="IPA" {{old('jurusan_pilihan')=='IPA'?'selected':''}}>IPA</option><option value="IPS" {{old('jurusan_pilihan')=='IPS'?'selected':''}}>IPS</option></select></div>
        </div>
        <!-- Jalur Pendaftaran -->
        <div class="border-t border-slate-100 pt-6">
            <h3 class="font-bold mb-4">Pilih Jalur Pendaftaran <span class="text-red-500">*</span></h3>
            <div class="flex gap-4 mb-6">
                <button type="button" onclick="setJalur('rapor')" id="btnRapor" class="flex-1 py-3 rounded-xl border-2 font-bold transition-all text-sm border-slate-300 text-theme-dark/60 hover:border-theme-dark">📊 Jalur Rapor</button>
                <button type="button" onclick="setJalur('zonasi')" id="btnZonasi" class="flex-1 py-3 rounded-xl border-2 font-bold transition-all text-sm border-slate-300 text-theme-dark/60 hover:border-theme-dark">📍 Jalur Zonasi</button>
            </div>
            <input type="hidden" name="jalur_pendaftaran" id="jalurInput" value="{{old('jalur_pendaftaran')}}">
            <!-- Rapor Fields -->
            <div id="raporFields" class="hidden space-y-4 bg-theme-light rounded-2xl p-6 border border-theme-green/20">
                <p class="text-sm font-bold text-theme-green">📊 Input Nilai Rapor</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-semibold mb-1">Nilai Rata-rata Semester 5</label><input type="number" step="0.01" min="0" max="100" name="nilai_rapor_sem5" value="{{old('nilai_rapor_sem5')}}" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="0-100"></div>
                    <div><label class="block text-sm font-semibold mb-1">Nilai Rata-rata Semester 6</label><input type="number" step="0.01" min="0" max="100" name="nilai_rapor_sem6" value="{{old('nilai_rapor_sem6')}}" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="0-100"></div>
                </div>
                <div><label class="block text-sm font-semibold mb-1">Upload Rapor (opsional, PDF/gambar)</label><input type="file" name="file_rapor" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-theme-green/10 file:text-theme-dark hover:file:bg-theme-green/20 cursor-pointer"></div>
            </div>
            <!-- Zonasi Fields -->
            <div id="zonasiFields" class="hidden space-y-4 bg-theme-light rounded-2xl p-6 border border-theme-green/20">
                <p class="text-sm font-bold text-theme-green">📍 Input Data Zonasi</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-semibold mb-1">Jarak Rumah ke Sekolah (km)</label><input type="number" step="0.1" min="0" name="jarak_rumah_km" value="{{old('jarak_rumah_km')}}" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="Contoh: 2.5"></div>
                    <div class="md:col-span-1"><label class="block text-sm font-semibold mb-1">Alamat Rumah (untuk zonasi)</label><textarea name="alamat_rumah_zonasi" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-theme-green transition text-sm" placeholder="Alamat lengkap...">{{old('alamat_rumah_zonasi')}}</textarea></div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 4: Upload Dokumen -->
    <div class="step p-8" data-step="4">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-theme-dark text-theme-light flex items-center justify-center text-sm">4</span>Upload Dokumen</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div><label class="block text-sm font-semibold mb-1">Pas Foto <span class="text-red-500">*</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG, maks 2MB</p><input type="file" name="pas_foto" accept=".jpg,.jpeg,.png" required class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
            <div><label class="block text-sm font-semibold mb-1">Ijazah / SKL <span class="text-red-500">*</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG/PDF, maks 5MB</p><input type="file" name="ijazah_skl" accept=".jpg,.jpeg,.png,.pdf" required class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
            <div><label class="block text-sm font-semibold mb-1">Kartu Keluarga <span class="text-red-500">*</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG/PDF, maks 5MB</p><input type="file" name="kartu_keluarga" accept=".jpg,.jpeg,.png,.pdf" required class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
            <div><label class="block text-sm font-semibold mb-1">Akte Kelahiran <span class="text-red-500">*</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG/PDF, maks 5MB</p><input type="file" name="akte_kelahiran" accept=".jpg,.jpeg,.png,.pdf" required class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
            <div><label class="block text-sm font-semibold mb-1">Kartu Pelajar <span class="text-theme-dark/40">(opsional)</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG/PDF</p><input type="file" name="kartu_pelajar" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
            <div><label class="block text-sm font-semibold mb-1">Sertifikat Prestasi <span class="text-theme-dark/40">(opsional)</span></label><p class="text-xs text-theme-dark/50 mb-1">JPG/PNG/PDF</p><input type="file" name="sertifikat_prestasi" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-theme-green/10 file:text-theme-dark cursor-pointer"></div>
        </div>
    </div>

    <!-- STEP 5: Konfirmasi -->
    <div class="step p-8" data-step="5">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-theme-dark text-theme-light flex items-center justify-center text-sm">5</span>Konfirmasi & Submit</h2>
        <div class="bg-theme-light rounded-2xl p-6 border border-theme-green/20 mb-6">
            <p class="text-sm text-theme-dark/70 mb-4">Pastikan semua data yang Anda isi sudah benar dan sesuai dengan dokumen resmi. Data yang telah dikirim tidak dapat diubah kembali.</p>
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="persetujuan_data" value="1" class="mt-1 w-5 h-5 rounded border-slate-300 text-theme-dark focus:ring-theme-green" required>
                <span class="text-sm font-medium">Saya menyatakan bahwa seluruh data dan dokumen yang saya isi dan unggah adalah benar dan dapat dipertanggungjawabkan. Saya bersedia menerima konsekuensi jika ditemukan ketidaksesuaian data.</span>
            </label>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="bg-slate-50 p-6 border-t border-slate-200 flex justify-between">
        <button type="button" id="prevBtn" onclick="changeStep(-1)" class="px-6 py-3 rounded-xl bg-white border border-slate-300 font-bold text-sm text-theme-dark hover:bg-slate-100 transition hidden">← Sebelumnya</button>
        <button type="button" id="nextBtn" onclick="changeStep(1)" class="px-8 py-3 rounded-xl bg-theme-dark text-theme-light font-bold text-sm hover:bg-theme-green transition ml-auto">Selanjutnya →</button>
        <button type="submit" id="submitBtn" class="px-8 py-3 rounded-xl bg-green-600 text-white font-bold text-sm hover:bg-green-700 transition ml-auto hidden">✓ Kirim Pendaftaran</button>
    </div>
    </form>
</div>
</main>

<script>
let currentStep=1;const totalSteps=5;
function updateUI(){
    document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
    document.querySelector(`[data-step="${currentStep}"]`).classList.add('active');
    const pct=Math.round((currentStep/totalSteps)*100);
    document.getElementById('progressBar').style.width=pct+'%';
    document.getElementById('stepLabel').textContent=`Step ${currentStep} dari ${totalSteps}`;
    document.getElementById('stepPercent').textContent=pct+'%';
    document.getElementById('prevBtn').classList.toggle('hidden',currentStep===1);
    document.getElementById('nextBtn').classList.toggle('hidden',currentStep===totalSteps);
    document.getElementById('submitBtn').classList.toggle('hidden',currentStep!==totalSteps);
}
function changeStep(dir){currentStep+=dir;if(currentStep<1)currentStep=1;if(currentStep>totalSteps)currentStep=totalSteps;updateUI();}
function setJalur(jalur){
    document.getElementById('jalurInput').value=jalur;
    const rF=document.getElementById('raporFields'),zF=document.getElementById('zonasiFields');
    const bR=document.getElementById('btnRapor'),bZ=document.getElementById('btnZonasi');
    if(jalur==='rapor'){
        rF.classList.remove('hidden');zF.classList.add('hidden');
        bR.classList.add('border-theme-dark','bg-theme-dark/5');bR.classList.remove('border-slate-300','text-theme-dark/60');
        bZ.classList.remove('border-theme-dark','bg-theme-dark/5');bZ.classList.add('border-slate-300','text-theme-dark/60');
        document.querySelector('[name="jarak_rumah_km"]').value='';
        document.querySelector('[name="alamat_rumah_zonasi"]').value='';
    } else {
        zF.classList.remove('hidden');rF.classList.add('hidden');
        bZ.classList.add('border-theme-dark','bg-theme-dark/5');bZ.classList.remove('border-slate-300','text-theme-dark/60');
        bR.classList.remove('border-theme-dark','bg-theme-dark/5');bR.classList.add('border-slate-300','text-theme-dark/60');
        document.querySelector('[name="nilai_rapor_sem5"]').value='';
        document.querySelector('[name="nilai_rapor_sem6"]').value='';
    }
}
// Init on load
document.addEventListener('DOMContentLoaded',function(){
    const saved='{{old("jalur_pendaftaran")}}';if(saved)setJalur(saved);
    updateUI();
});
</script>
</body>
</html>
