<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            // Step 1: Data Pribadi
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:applicants,nisn',
            'nik' => 'required|string|size:16',
            'gender' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',

            // Step 2: Data Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255',
            'hp_ortu' => 'required|string|max:20',
            'alamat_ortu' => 'nullable|string',

            // Step 3: Data Sekolah Asal
            'previous_school' => 'required|string|max:255',
            'alamat_sekolah_asal' => 'required|string',
            'tahun_lulus' => 'required|string|size:4',

            // Step 4: Jalur Pendaftaran
            'jalur_pendaftaran' => 'required|in:rapor,zonasi',
            'jurusan_pilihan' => 'required|string|max:255',

            // Zonasi fields
            'jarak_rumah_km' => 'required_if:jalur_pendaftaran,zonasi|nullable|numeric|min:0',
            'alamat_rumah_zonasi' => 'required_if:jalur_pendaftaran,zonasi|nullable|string',

            // Rapor fields
            'nilai_rapor_sem5' => 'required_if:jalur_pendaftaran,rapor|nullable|numeric|min:0|max:100',
            'nilai_rapor_sem6' => 'required_if:jalur_pendaftaran,rapor|nullable|numeric|min:0|max:100',
            'file_rapor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            // Step 5: Upload Dokumen
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'ijazah_skl' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kartu_keluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte_kelahiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kartu_pelajar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sertifikat_prestasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'dokumen_tambahan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            // Step 6: Persetujuan
            'persetujuan_data' => 'required|accepted',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'tahun_lulus.size' => 'Tahun lulus harus 4 digit (contoh: 2026).',
            'persetujuan_data.accepted' => 'Anda harus menyetujui bahwa data yang diisi sudah benar.',
            'jarak_rumah_km.required_if' => 'Jarak rumah ke sekolah wajib diisi untuk jalur Zonasi.',
            'alamat_rumah_zonasi.required_if' => 'Alamat rumah wajib diisi untuk jalur Zonasi.',
            'nilai_rapor_sem5.required_if' => 'Nilai rapor semester 5 wajib diisi untuk jalur Rapor.',
            'nilai_rapor_sem6.required_if' => 'Nilai rapor semester 6 wajib diisi untuk jalur Rapor.',
        ];
    }
}
