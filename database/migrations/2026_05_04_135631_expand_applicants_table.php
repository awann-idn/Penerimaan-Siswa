<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Data Pribadi Tambahan
            $table->string('nik', 20)->nullable()->after('nisn');
            $table->string('agama')->nullable()->after('gender');

            // Data Orang Tua
            $table->string('nama_ayah')->nullable()->after('address');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
            $table->string('pekerjaan_ortu')->nullable()->after('nama_ibu');
            $table->string('hp_ortu', 20)->nullable()->after('pekerjaan_ortu');
            $table->text('alamat_ortu')->nullable()->after('hp_ortu');

            // Data Sekolah Asal Tambahan
            $table->text('alamat_sekolah_asal')->nullable()->after('previous_school');
            $table->string('tahun_lulus', 4)->nullable()->after('alamat_sekolah_asal');

            // Jalur Pendaftaran
            $table->enum('jalur_pendaftaran', ['rapor', 'zonasi'])->nullable()->after('tahun_lulus');
            $table->string('jurusan_pilihan')->nullable()->after('jalur_pendaftaran');

            // Zonasi
            $table->decimal('jarak_rumah_km', 8, 2)->nullable()->after('jurusan_pilihan');
            $table->text('alamat_rumah_zonasi')->nullable()->after('jarak_rumah_km');

            // Rapor
            $table->decimal('nilai_rapor_sem5', 5, 2)->nullable()->after('alamat_rumah_zonasi');
            $table->decimal('nilai_rapor_sem6', 5, 2)->nullable()->after('nilai_rapor_sem5');
            $table->string('file_rapor')->nullable()->after('nilai_rapor_sem6');

            // Upload Dokumen Tambahan
            $table->string('ijazah_skl')->nullable()->after('file_rapor');
            $table->string('kartu_keluarga')->nullable()->after('ijazah_skl');
            $table->string('akte_kelahiran')->nullable()->after('kartu_keluarga');
            $table->string('sertifikat_prestasi')->nullable()->after('akte_kelahiran');

            // Administrasi Pasca-Kelulusan
            $table->string('nomor_registrasi')->nullable()->after('admin_notes');
            $table->string('nomor_surat_kelulusan')->nullable()->after('nomor_registrasi');
            $table->string('bukti_pembayaran')->nullable()->after('nomor_surat_kelulusan');
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas'])->default('belum_bayar')->after('bukti_pembayaran');
            $table->decimal('biaya_pendaftaran', 12, 2)->nullable()->after('status_pembayaran');
            $table->text('info_daftar_ulang')->nullable()->after('biaya_pendaftaran');
            $table->date('jadwal_daftar_ulang')->nullable()->after('info_daftar_ulang');
            $table->date('jadwal_mpls')->nullable()->after('jadwal_daftar_ulang');

            // Persetujuan
            $table->boolean('persetujuan_data')->default(false)->after('jadwal_mpls');
        });
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'agama',
                'nama_ayah', 'nama_ibu', 'pekerjaan_ortu', 'hp_ortu', 'alamat_ortu',
                'alamat_sekolah_asal', 'tahun_lulus',
                'jalur_pendaftaran', 'jurusan_pilihan',
                'jarak_rumah_km', 'alamat_rumah_zonasi',
                'nilai_rapor_sem5', 'nilai_rapor_sem6', 'file_rapor',
                'ijazah_skl', 'kartu_keluarga', 'akte_kelahiran', 'sertifikat_prestasi',
                'nomor_registrasi', 'nomor_surat_kelulusan',
                'bukti_pembayaran', 'status_pembayaran', 'biaya_pendaftaran',
                'info_daftar_ulang', 'jadwal_daftar_ulang', 'jadwal_mpls',
                'persetujuan_data',
            ]);
        });
    }
};
