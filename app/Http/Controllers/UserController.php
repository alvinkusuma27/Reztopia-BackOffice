<?php

namespace App\Http\Controllers;

use App\Models\Password_resets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPSTORM_META\map;

class UserController extends Controller
{

    public function forgot()
    {
        return view('tenant.auth.forgot-password');
    }

    public function sent_forgot_password()
    {
        return view('tenant.auth.sent-forgot-password');
    }

    public function success_reset()
    {
        return view('tenant.auth.success-reset');
    }

    public function req_password()
    {
        $active = 'req_pass';
        return view('tenant.page.req_pass', compact('active'));
    }
    public function forgot_store(Request $request)
    {
        $messages = [
            'email.required' => 'e-mail cannot be empty',
            'email.email' => 'Enter the correct e-mail format'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], $messages);

        // $code = Str::random(30);
        $token = bin2hex(Hash::make(Str::random(30)));

        $date = Carbon::now();

        $month = $date->format('M');
        $year = $date->format('Y');
        $ip = geoIP()->getLocation($_SERVER['REMOTE_ADDR'])->toArray();

        // dd($request->all());
        $email_ada = User::where('email', $request->email)->get();
        // dd($email_ada);
        if (!empty($email_ada[0])) {
            $phone = $email_ada[0]->phone;
            $reset = new Password_resets();
            if (!$validator->fails()) {
                $reset->email = $request->email;
                $reset->token = $token;
                $reset->created_at = $date;
                $reset->ip = $ip['ip'];
                $reset->country = $ip['country'];
                $reset->city = $ip['city'];
                $reset->month = $month;
                $reset->year = $year;
                $reset->status = 0;
                // dd($reset, $request->all(), $ip);
                // $token2 = hex2bin($reset->token);

                $reset->save();
                Alert::toast('Password will be sent via whatsapp', 'success');
                $text = "SELAMAT DATANG, UNTUK MELAKUKAN RESET PASSWORD SILAHKAN KLIK LINK INI " . route('reset-password', $token);
                $pesan = "https://wa.me/$phone?text=$text";
                return Redirect::away($pesan);
            } else {
                Alert::toast($validator->messages()->all(), 'error');
            }
        } else {
            Alert::toast("Email not registered", 'error');
        }
        return back();
    }

    public function reset_password($token)
    {
        //
    }

    public function reset_password_store(Request $request)
    {
        $validator = Validator::make($request->all, [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'token' => 'required'
        ]);

        if (!$validator->fails()) {
            $data = User::where('email', $request->email)->get();
            if (!empty($data[0])) {
                $token = Password_resets::where('email', $request->email);
                $update_token = Password_resets::findOrFail($token[0]->id);
            }
        }
    }
}
