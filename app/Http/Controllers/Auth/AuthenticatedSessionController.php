<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi dan autentikasi user
        $request->authenticate();

        // Regenerasi sesi agar lebih aman
        $request->session()->regenerate();

        // Ambil data user yang sedang login
        $user = Auth::user();

        // 🔹 Redirect berdasarkan role
        if ($user->role === 'admin') {
            // Kalau admin, arahkan ke dashboard admin
            return redirect()->route('dashboard');
        }

        // 🔹 Cek apakah user sudah punya data eKYC
        $ekyc = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();

        if ($ekyc && $ekyc->status === 'submitted') {
            // Kalau status sudah "submitted", langsung ke step terakhir
            return redirect()->route('ekyc.step5');
        } else {
            // Kalau belum, mulai dari step 1
            return redirect()->route('ekyc.step1');
        }
    }

    /**
     * Logout user dari aplikasi
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout user
        Auth::guard('web')->logout();

        // Hapus semua data sesi lama
        $request->session()->invalidate();

        // Regenerasi token untuk keamanan CSRF
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect('/login');
    }
}