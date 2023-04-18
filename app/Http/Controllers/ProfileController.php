<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $active = 'profile';
        $id = Auth::user()->id;
        $outlet = Outlet::with('user')->where('id_user', $id)->get();
        // dd($outlet);
        return view('tenant.page.profile', compact('active', 'outlet'));
    }

    public function update_profile(Request $request)
    {
        dd($request->all());
    }

    public function update_image_profile(Request $request)
    {
        dd($request->all());
    }

    public function change_password()
    {
        //
    }
}
