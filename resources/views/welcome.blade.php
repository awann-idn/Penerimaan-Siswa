<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB SMA Unggulan AFINY Palembang | SPARTA</title>
    <meta name="description" content="Sistem Pendaftaran Terpadu Akademik (SPARTA) - Penerimaan Peserta Didik Baru SMA Unggulan AFINY Palembang">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;vertical-align:middle;line-height:1}
        .icon-filled{font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24}
    </style>
    

</head>
<body class="bg-theme-light text-theme-dark antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-theme-light/90 backdrop-blur-md border-b border-theme-tan/30 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-theme-dark flex items-center justify-center text-theme-light font-bold text-xl shadow-lg shadow-theme-dark/30">A</div>
                    <span class="font-bold text-xl tracking-tight text-theme-dark">SPARTA</span>
                </div>
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#beranda" class="text-theme-dark/80 hover:text-theme-green font-semibold transition">Beranda</a>
                    <a href="#tentang" class="text-theme-dark/80 hover:text-theme-green font-semibold transition">Tentang</a>
                    <a href="#alur" class="text-theme-dark/80 hover:text-theme-green font-semibold transition">Alur</a>
                    <a href="#informasi" class="text-theme-dark/80 hover:text-theme-green font-semibold transition">Syarat</a>
                    <a href="/register" class="px-5 py-2.5 rounded-full bg-theme-dark text-theme-light font-bold hover:bg-theme-green transition-all duration-300 shadow-md">Daftar Sekarang</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('siswa.dashboard') }}" class="px-5 py-2.5 rounded-full bg-theme-green text-theme-light font-bold shadow-md">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-theme-dark/60 font-semibold hover:text-red-500 transition">Logout</button>
                        </form>
                    @else
                        <a href="/login" class="text-theme-dark font-semibold hover:text-theme-green transition">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-20 left-1/4 w-96 h-96 bg-theme-tan/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute top-20 right-1/4 w-96 h-96 bg-theme-green/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/60 border border-theme-tan/50 text-theme-dark font-bold text-sm mb-8 backdrop-blur-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                Pendaftaran PPDB 2026 Telah Dibuka!
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8 text-theme-dark">
                SMA Unggulan <br class="hidden md:block" />
                <span class="text-theme-green">AFINY Palembang</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-theme-dark/80 mb-10 leading-relaxed font-medium">
                Sistem Pendaftaran Terpadu Akademik (SPARTA) — Proses penerimaan peserta didik baru yang mudah, cepat, dan transparan untuk calon siswa-siswi terbaik Sumatera Selatan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="/register" class="w-full sm:w-auto px-8 py-4 rounded-full bg-theme-dark text-theme-light font-bold text-lg shadow-lg hover:bg-theme-green hover:-translate-y-1 transition-all duration-300">Mulai Pendaftaran</a>
                <a href="#alur" class="w-full sm:w-auto px-8 py-4 rounded-full bg-white text-theme-dark font-bold text-lg shadow-sm border border-theme-green/40 hover:bg-theme-green/10 transition-all duration-300">Pelajari Alurnya</a>
            </div>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-theme-dark">Tentang SMA Unggulan AFINY</h2>
                <p class="text-theme-dark/70 max-w-3xl mx-auto leading-relaxed">SMA Unggulan AFINY Palembang merupakan lembaga pendidikan menengah atas yang berkomitmen mencetak generasi muda yang unggul, berkarakter, dan berdaya saing tinggi di tingkat nasional maupun internasional.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-theme-light rounded-2xl p-6 shadow-md border border-theme-green/10 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-theme-dark/10 flex items-center justify-center mb-4 text-2xl"><span class="material-symbols-outlined">school</span></div>
                    <h3 class="font-bold text-lg mb-2 text-theme-dark">Kurikulum Merdeka</h3>
                    <p class="text-sm text-theme-dark/70">Menerapkan Kurikulum Merdeka dengan pendekatan pembelajaran berbasis proyek dan diferensiasi untuk mengoptimalkan potensi setiap siswa.</p>
                </div>
                <div class="bg-theme-light rounded-2xl p-6 shadow-md border border-theme-green/10 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-theme-dark/10 flex items-center justify-center mb-4 text-2xl"><span class="material-symbols-outlined">home_work</span></div>
                    <h3 class="font-bold text-lg mb-2 text-theme-dark">Fasilitas Modern</h3>
                    <p class="text-sm text-theme-dark/70">Dilengkapi laboratorium IPA, lab komputer, perpustakaan digital, ruang multimedia, serta sarana olahraga lengkap.</p>
                </div>
                <div class="bg-theme-light rounded-2xl p-6 shadow-md border border-theme-green/10 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-theme-dark/10 flex items-center justify-center mb-4"><span class="material-symbols-outlined icon-filled text-theme-dark/60" style="font-size:32px">emoji_events</span></div>
                    <h3 class="font-bold text-lg mb-2 text-theme-dark">Prestasi Gemilang</h3>
                    <p class="text-sm text-theme-dark/70">Alumni tersebar di perguruan tinggi ternama. Aktif meraih prestasi di bidang akademik, sains, seni, dan olahraga.</p>
                </div>
                <div class="bg-theme-light rounded-2xl p-6 shadow-md border border-theme-green/10 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-theme-dark/10 flex items-center justify-center mb-4"><span class="material-symbols-outlined text-theme-dark/60" style="font-size:32px">handshake</span></div>
                    <h3 class="font-bold text-lg mb-2 text-theme-dark">Pendidikan Karakter</h3>
                    <p class="text-sm text-theme-dark/70">Menanamkan nilai-nilai integritas, kedisiplinan, dan kepemimpinan melalui program pembinaan karakter yang terintegrasi.</p>
                </div>
            </div>

            <!-- Info Singkat Sekolah -->
            <div class="mt-16 bg-theme-dark rounded-3xl p-8 md:p-12 text-theme-light">
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div>
                        <p class="text-4xl font-extrabold text-theme-tan mb-1">2</p>
                        <p class="text-theme-light/70 font-medium">Jurusan Tersedia</p>
                        <p class="text-sm text-theme-light/50 mt-1">IPA & IPS</p>
                    </div>
                    <div>
                        <p class="text-4xl font-extrabold text-theme-tan mb-1">2</p>
                        <p class="text-theme-light/70 font-medium">Jalur Pendaftaran</p>
                        <p class="text-sm text-theme-light/50 mt-1">Rapor & Zonasi</p>
                    </div>
                    <div>
                        <div class="flex justify-center mb-1"><span class="material-symbols-outlined icon-filled text-theme-tan" style="font-size:42px">location_on</span></div>
                        <p class="text-theme-light/70 font-medium">Lokasi</p>
                        <p class="text-sm text-theme-light/50 mt-1">Palembang, Sumatera Selatan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran -->
    <section id="alur" class="py-20 bg-theme-dark text-theme-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-theme-tan">Alur Pendaftaran PPDB</h2>
                <p class="text-theme-light/80 max-w-2xl mx-auto">Ikuti langkah-langkah berikut untuk menjadi bagian dari SMA Unggulan AFINY Palembang.</p>
            </div>
            <div class="grid md:grid-cols-5 gap-6">
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-theme-green flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition-transform">1</div>
                    <h3 class="font-bold mb-1 text-theme-tan">Buat Akun</h3>
                    <p class="text-theme-light/60 text-xs">Daftar akun di sistem SPARTA.</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-theme-tan/80 text-theme-dark flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition-transform">2</div>
                    <h3 class="font-bold mb-1 text-theme-tan">Isi Formulir</h3>
                    <p class="text-theme-light/60 text-xs">Lengkapi data diri, orang tua, dan sekolah asal.</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-theme-green flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition-transform">3</div>
                    <h3 class="font-bold mb-1 text-theme-tan">Upload Berkas</h3>
                    <p class="text-theme-light/60 text-xs">Unggah pas foto, ijazah, KK, dan akte lahir.</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-theme-tan/80 text-theme-dark flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition-transform">4</div>
                    <h3 class="font-bold mb-1 text-theme-tan">Verifikasi Admin</h3>
                    <p class="text-theme-light/60 text-xs">Panitia mereview kelengkapan data Anda.</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-theme-green flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition-transform">5</div>
                    <h3 class="font-bold mb-1 text-theme-tan">Cek Kelulusan</h3>
                    <p class="text-theme-light/60 text-xs">Lihat hasil dan cetak surat kelulusan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi & Persyaratan -->
    <section id="informasi" class="py-20 bg-theme-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-6 text-theme-dark">Persyaratan Pendaftaran</h2>
                    <p class="text-theme-dark/70 mb-8 leading-relaxed">Pastikan Anda telah menyiapkan data dan dokumen berikut sebelum memulai proses pendaftaran online.</p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 bg-white rounded-xl p-4 border border-theme-green/10">
                            <span class="material-symbols-outlined icon-filled text-theme-green mt-0.5" style="font-size:20px">check_circle</span>
                            <div><h4 class="font-bold text-theme-dark">NISN & NIK</h4><p class="text-xs text-theme-dark/60">Nomor Induk Siswa Nasional & Nomor Induk Kependudukan (16 digit).</p></div>
                        </div>
                        <div class="flex items-start gap-3 bg-white rounded-xl p-4 border border-theme-green/10">
                            <span class="material-symbols-outlined icon-filled text-theme-green mt-0.5" style="font-size:20px">check_circle</span>
                            <div><h4 class="font-bold text-theme-dark">Data Diri & Orang Tua</h4><p class="text-xs text-theme-dark/60">Nama lengkap, TTL, alamat, data ayah & ibu, serta kontak aktif.</p></div>
                        </div>
                        <div class="flex items-start gap-3 bg-white rounded-xl p-4 border border-theme-green/10">
                            <span class="material-symbols-outlined icon-filled text-theme-green mt-0.5" style="font-size:20px">check_circle</span>
                            <div><h4 class="font-bold text-theme-dark">Dokumen Wajib</h4><p class="text-xs text-theme-dark/60">Pas foto, Ijazah/SKL, Kartu Keluarga, dan Akte Kelahiran (scan/foto).</p></div>
                        </div>
                        <div class="flex items-start gap-3 bg-white rounded-xl p-4 border border-theme-green/10">
                            <span class="material-symbols-outlined icon-filled text-theme-green mt-0.5" style="font-size:20px">check_circle</span>
                            <div><h4 class="font-bold text-theme-dark">Pilih Jalur: Rapor atau Zonasi</h4><p class="text-xs text-theme-dark/60">Jalur Rapor: input nilai semester 5 & 6. Jalur Zonasi: input jarak rumah ke sekolah.</p></div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-theme-green/20">
                        <h3 class="text-2xl font-bold mb-6 text-center text-theme-dark border-b border-theme-light pb-4">Jadwal PPDB 2026</h3>
                        <div class="space-y-5">
                            <div class="flex justify-between items-center"><div><p class="font-bold text-theme-dark">Pendaftaran Online</p><p class="text-xs text-theme-dark/50">Pengisian formulir via SPARTA</p></div><p class="font-bold text-theme-green text-sm">10 Mei — 20 Jun</p></div>
                            <div class="flex justify-between items-center"><div><p class="font-bold text-theme-dark">Verifikasi Berkas</p><p class="text-xs text-theme-dark/50">Oleh panitia PPDB</p></div><p class="font-bold text-theme-green text-sm">21 — 25 Jun</p></div>
                            <div class="flex justify-between items-center"><div><p class="font-bold text-theme-dark">Pengumuman Kelulusan</p><p class="text-xs text-theme-dark/50">Cek di akun siswa</p></div><p class="font-bold text-theme-dark text-sm">28 Juni 2026</p></div>
                            <div class="flex justify-between items-center"><div><p class="font-bold text-theme-dark">Daftar Ulang</p><p class="text-xs text-theme-dark/50">Pembayaran & berkas</p></div><p class="font-bold text-theme-dark text-sm">29 Jun — 5 Jul</p></div>
                            <div class="flex justify-between items-center"><div><p class="font-bold text-theme-dark">MPLS</p><p class="text-xs text-theme-dark/50">Masa Pengenalan Lingkungan Sekolah</p></div><p class="font-bold text-theme-dark text-sm">14 — 16 Juli 2026</p></div>
                        </div>
                        <a href="/register" class="mt-8 block w-full py-4 text-center rounded-xl bg-theme-dark text-theme-light font-bold hover:bg-theme-green transition-colors">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-theme-dark text-theme-light py-10 border-t-4 border-theme-green">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-theme-tan flex items-center justify-center text-theme-dark font-bold">A</div>
                <span class="font-bold text-lg text-theme-tan">SPARTA — SMA Unggulan AFINY</span>
            </div>
            <p class="text-theme-light/60 text-sm">&copy; 2026 SMA Unggulan AFINY Palembang. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
