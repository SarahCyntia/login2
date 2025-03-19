<?php 

namespace App\Http\Controllers;

// use App\Mail\SendEmail;
use App\Models\User;
// use Cache;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Mail;
// use Validator;

class OtpController extends Controller {

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|numeric:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input!'], 400);
        }

        $user = user::where('email', $request->email)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired OTP!'], 400);
        }

        // $otp->delete(); // Hapus OTP setelah berhasil diverifikasi

        return response()->json(['message' => 'OTP Verified!'], 200);
    }
}