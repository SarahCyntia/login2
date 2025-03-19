<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class VerifikasiController extends Controller
{
    /**
     * Menampilkan halaman verifikasi OTP
     */
    public function showVerificationForm()
    {
        return response()->json(['message' => 'Silahkan masukkan kode OTP'], 200);
    }
    /**
     * Mengirim OTP ke email pengguna
     */
    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     // Generate OTP 6 digit
    //     $otp = mt_rand(100000, 999999);
        
    //     // Simpan OTP ke database
    //     $user->otp = $otp;
    //     $user->otp_expired_at = Carbon::now()->addMinutes(5); // OTP berlaku 5 menit
    //     $user->save();

    //     // Kirim OTP via email
    //     // Mail::to($user->email)->send(new SendOtpMail($otp));
        
    //     // Untuk testing, return OTP (pada implementasi sebenarnya, hapus ini)
    //     return response()->json([
    //         'message' => 'OTP berhasil dikirim ke email Anda',
    //         'otp' => $otp // Hapus di produksi
    //     ], 200);
    // }

    /**
     * Verifikasi OTP yang dimasukkan pengguna
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah OTP valid dan belum expired
        if (!$user || $user->otp != $request->otp || Carbon::now()->isAfter($user->otp_expired_at)) {
            return response()->json([
                'message' => 'OTP tidak valid atau sudah expired',
                'status' => 'error'
            ], 422);
        }

        // Reset OTP setelah digunakan
        $user->otp = null;
        $user->otp_expired_at = null;
        // $user->email_verified_at = Carbon::now();
        $user->save();

        // Login user
        // Auth::login($user);

        // return response()->json([
        //     'message' => 'Verifikasi berhasil',
        //     'status' => 'success',
        //     'redirect' => '/home',
        //     'user' => $user
        // ], 200);
    }

    /**
     * Resend OTP if expired
     */
    // public function resendOtp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     // Delay untuk mencegah abuse
    //     sleep(1);

    //     return $this->sendOtp($request);
    // }
}