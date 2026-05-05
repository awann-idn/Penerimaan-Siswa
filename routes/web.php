<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;  // ← TAMBAHKAN INI
use App\Http\Controllers\ApplicantController;
use App\Models\User;
use App\Models\Applicant;

// ─── Public ─────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ─── Auth (Public Login) ─────────────────────────────
Route::get('/login', fn() => view('auth.login'))->name('login');

Route::middleware('guest')->group(function () {
    // Route::get('/login', fn() => view('auth.login'))->name('login');

    Route::post('/login', function () {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    });

    Route::get('/register', fn() => view('auth.register'))->name('register');

    Route::post('/register', function () {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa',
        ]);

        Auth::login($user);
        return redirect()->route('siswa.dashboard');
    });
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

// ─── Siswa Routes ───────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/siswa/dashboard', function () {
        $applicant = auth()->user()->applicant;
        return view('siswa.dashboard', compact('applicant'));
    })->name('siswa.dashboard');

    Route::get('/siswa/daftar', [ApplicantController::class, 'create'])->name('siswa.daftar');
    Route::post('/siswa/daftar', [ApplicantController::class, 'store'])->name('siswa.daftar.store');
    Route::get('/siswa/kelulusan', [ApplicantController::class, 'kelulusan'])->name('siswa.kelulusan');
    Route::get('/siswa/surat-kelulusan', [ApplicantController::class, 'cetakSuratKelulusan'])->name('siswa.surat-kelulusan');
    Route::post('/siswa/upload-pembayaran', [ApplicantController::class, 'uploadBuktiPembayaran'])->name('siswa.upload-pembayaran');
});

// ─── Admin Routes ───────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $applicants = Applicant::with('user')->latest()->get();
        $stats = [
            'total' => $applicants->count(),
            'pending' => $applicants->where('status', 'pending')->count(),
            'verified' => $applicants->whereIn('status', ['accepted', 'rejected'])->count(),
            'accepted' => $applicants->where('status', 'accepted')->count(),
            'rejected' => $applicants->where('status', 'rejected')->count(),
        ];
        return view('admin.dashboard', compact('applicants', 'stats'));
    })->name('admin.dashboard');

    Route::get('/admin/applicants/{applicant}', [ApplicantController::class, 'show'])->name('admin.applicant.show');
    Route::patch('/admin/applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('admin.applicant.status');
    Route::patch('/admin/applicants/{applicant}/payment', [ApplicantController::class, 'verifyPayment'])->name('admin.applicant.payment');
});

// ─── TEST ROUTE (Hapus setelah selesai debugging) ───
Route::get('/setup-admin', function() {
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'afiny@gmaill.com'],
        [
            'name' => 'Admin Afiny',
            'password' => \Illuminate\Support\Facades\Hash::make('Afiny123'),
            'role' => 'admin'
        ]
    );
    return "Akun Admin Berhasil Dibuat/Diupdate! Silakan login dengan afiny@gmaill.com / Afiny123. JANGAN LUPA HAPUS ROUTE INI SETELAH BERHASIL.";
});

Route::get('/db-test', function() {
    try {
        DB::connection()->getPdo();
        
        $userCount = User::count();
        $applicantCount = Applicant::count();
        
        return response()->json([
            'status' => 'success',
            'database_connected' => true,
            'user_count' => $userCount,
            'applicant_count' => $applicantCount,
            'database' => DB::connection()->getDatabaseName(),
            'host' => config('database.connections.mysql.host'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});