<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Http\Requests\StoreApplicantRequest;

class ApplicantController extends Controller
{
    /**
     * Show the multi-step registration form (siswa).
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->applicant) {
            return redirect()->route('siswa.dashboard');
        }
        return view('applicants.create');
    }

    /**
     * Store registration (siswa submit form).
     */
    public function store(StoreApplicantRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['persetujuan_data'] = true;

        // Clear jalur-specific fields based on selection
        if ($data['jalur_pendaftaran'] === 'zonasi') {
            $data['nilai_rapor_sem5'] = null;
            $data['nilai_rapor_sem6'] = null;
        } else {
            $data['jarak_rumah_km'] = null;
            $data['alamat_rumah_zonasi'] = null;
        }

        // Handle all file uploads
        $fileFields = [
            'pas_foto' => 'uploads/pas_foto',
            'ijazah_skl' => 'uploads/ijazah_skl',
            'kartu_keluarga' => 'uploads/kartu_keluarga',
            'akte_kelahiran' => 'uploads/akte_kelahiran',
            'kartu_pelajar' => 'uploads/kartu_pelajar',
            'sertifikat_prestasi' => 'uploads/sertifikat_prestasi',
            'dokumen_tambahan' => 'uploads/dokumen_tambahan',
            'file_rapor' => 'uploads/file_rapor',
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store($path, 'public');
            } else {
                unset($data[$field]);
            }
        }

        Applicant::create($data);

        return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim! Silakan tunggu proses verifikasi.');
    }

    /**
     * Admin: show applicant detail
     */
    public function show(Applicant $applicant)
    {
        return view('admin.applicant-detail', compact('applicant'));
    }

    /**
     * Admin: update status (verified -> accepted/rejected)
     */
    public function updateStatus(Applicant $applicant)
    {
        $validated = request()->validate([
            'status' => 'required|in:pending,verified,accepted,rejected',
            'admin_notes' => 'nullable|string|max:1000',
            'nomor_registrasi' => 'nullable|string|max:50',
            'biaya_pendaftaran' => 'nullable|numeric|min:0',
            'info_daftar_ulang' => 'nullable|string',
            'jadwal_daftar_ulang' => 'nullable|date',
            'jadwal_mpls' => 'nullable|date',
        ]);

        // Generate nomor surat kelulusan if accepted
        if ($validated['status'] === 'accepted' && !$applicant->nomor_surat_kelulusan) {
            $validated['nomor_surat_kelulusan'] = 'SKL/' . date('Y') . '/' . str_pad($applicant->id, 4, '0', STR_PAD_LEFT);
        }

        // Generate nomor registrasi if accepted and not yet set
        if ($validated['status'] === 'accepted' && empty($validated['nomor_registrasi'])) {
            $validated['nomor_registrasi'] = 'REG-' . date('Y') . '-' . str_pad($applicant->id, 4, '0', STR_PAD_LEFT);
        }

        $applicant->update($validated);

        return redirect()->route('admin.applicant.show', $applicant)->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    /**
     * Admin: verify payment
     */
    public function verifyPayment(Applicant $applicant)
    {
        $validated = request()->validate([
            'status_pembayaran' => 'required|in:belum_bayar,menunggu_verifikasi,lunas',
        ]);

        $applicant->update($validated);

        return redirect()->route('admin.applicant.show', $applicant)->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /**
     * Siswa: upload bukti pembayaran
     */
    public function uploadBuktiPembayaran()
    {
        $validated = request()->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $applicant = auth()->user()->applicant;

        if (!$applicant || $applicant->status !== 'accepted') {
            abort(403);
        }

        $path = request()->file('bukti_pembayaran')->store('uploads/bukti_pembayaran', 'public');
        $applicant->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu_verifikasi',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    /**
     * Siswa: halaman cek kelulusan
     */
    public function kelulusan()
    {
        $applicant = auth()->user()->applicant;

        if (!$applicant || !in_array($applicant->status, ['accepted', 'rejected'])) {
            return redirect()->route('siswa.dashboard');
        }

        return view('siswa.kelulusan', compact('applicant'));
    }

    /**
     * Siswa: cetak surat kelulusan (printable HTML)
     */
    public function cetakSuratKelulusan()
    {
        $applicant = auth()->user()->applicant;

        if (!$applicant || $applicant->status !== 'accepted') {
            abort(403);
        }

        return view('siswa.surat-kelulusan', compact('applicant'));
    }
}
