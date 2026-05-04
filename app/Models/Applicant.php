<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        // Data Pribadi
        'nisn', 'nik', 'full_name', 'gender', 'agama',
        'birth_place', 'birth_date', 'phone_number', 'address',
        // Data Orang Tua
        'nama_ayah', 'nama_ibu', 'pekerjaan_ortu', 'hp_ortu', 'alamat_ortu',
        // Data Sekolah Asal
        'previous_school', 'alamat_sekolah_asal', 'tahun_lulus',
        // Jalur Pendaftaran
        'jalur_pendaftaran', 'jurusan_pilihan',
        'jarak_rumah_km', 'alamat_rumah_zonasi',
        'nilai_rapor_sem5', 'nilai_rapor_sem6', 'file_rapor',
        // Upload Dokumen
        'pas_foto', 'kartu_pelajar', 'dokumen_tambahan',
        'ijazah_skl', 'kartu_keluarga', 'akte_kelahiran', 'sertifikat_prestasi',
        // Status & Admin
        'status', 'admin_notes',
        'nomor_registrasi', 'nomor_surat_kelulusan',
        // Pembayaran
        'bukti_pembayaran', 'status_pembayaran', 'biaya_pendaftaran',
        'info_daftar_ulang', 'jadwal_daftar_ulang', 'jadwal_mpls',
        // Persetujuan
        'persetujuan_data',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'jadwal_daftar_ulang' => 'date',
        'jadwal_mpls' => 'date',
        'persetujuan_data' => 'boolean',
        'biaya_pendaftaran' => 'decimal:2',
        'jarak_rumah_km' => 'decimal:2',
        'nilai_rapor_sem5' => 'decimal:2',
        'nilai_rapor_sem6' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
