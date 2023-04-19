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
}
