<?php 


namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class LoginOtpController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()], 400);
        // }

        $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return response()->json(['message' => 'Email atau password salah!'], 401);
        // }

        // Generate OTP
        $otpCode = rand(100000, 999999);

        // if (!$user) {
        //     return response()->json(['message' => 'Email tidak terdaftar!'], 404);
        // }
        // User::updateOrCreate(
        //     ['email' => $request->email],
        //     ['code' => $otpCode, 'created_at' => now()]
        // );

        $user->otp = $otpCode;
        $user->otp_expires = now()->addMinutes(10);
        $user->save();

        // Send OTP via email
        Mail::to($request->email)->send(new SendEmail($otpCode));

        return response()->json([
            'message' => 'Kode OTP telah dikirim ke email Anda.',
        ]);
    }

    // public function verify(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'otp' => 'required|digits:6',
    //     ]);

    //     $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

    //     if (!$user) {
    //         return response()->json(['message' => 'Kode OTP tidak valid atau telah kedaluwarsa.'], 400);
    //     }

    //     // Delete OTP after successful verification
    //     // $otp->delete();

    //     // $user = User::where('email', $request->email)->first();
    //     // $token = $user->createToken('auth_token')->plainTextToken;
    //     $user->otp = null;
    //     $user->otp_expires = null;
    //     $user->save;

    //     return response()->json([
    //         'message' => 'Login berhasil!',
    //         'user' => $user,
    //         // 'token' => $token
    //     ]);
    // }
    // public function sendOTP(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email'
    //     ]);
        
    //     $otp = rand(100000, 999999);
        
    //     Cache::put($request->email, $otp, now()->addMinutes(5));

    //     // Mail::raw("Your OTP code is: $otp", function ($message) use ($request) {
    //     //     $message->to($request->email)->subject("Your OTP Code");
    //     // });
    //     Mail::to($request->email)->send(new SendEmail($otp));

    //     return response()->json(['message' => 'OTP sent successfully']);
    // }
}