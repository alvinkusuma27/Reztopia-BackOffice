<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $active = 'profile';
            $id = Auth::user()->id;
            // $user = Auth::user()->name;
            // dd($user);
            $outlet = Outlet::with('user')->where('id_user', $id)->get();
            $coba = asset('/storage/uploads/user/') . $outlet[0]->user[0]->image;
            // dd($coba, $outlet);
            // dd($outlet);
            return view('tenant.page.profile', compact('active', 'outlet'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function update_profile(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $id = Auth::user()->id;
            if (!$validator->fails()) {
                $user = User::findOrFail($id);
                // $user_name = Auth::user()->name;
                // if ($request->hasFile('image')) {
                //     $image = $request->file('image');
                //     $image_name = time() . '-user-update-' . $user_name . '.' . $image->getClientOriginalExtension();
                //     Storage::putFileAs('public/uploads/user/', $image, $image_name);
                //     if (Auth::user()->roles == 'kantin') {
                //         $user->update([
                //             'image' => $image_name,
                //             'position' => $request->position,
                //             'name' => $request->name
                //         ]);
                //     } elseif (Auth::user()->roles == 'admin') {
                //     }
                // } else {

                if (Auth::user()->roles == 'kantin') {
                    $user->update([
                        'position' => $request->position,
                        'name' => $request->name
                    ]);
                } elseif (Auth::user()->roles == 'admin') {
                    $user->update([
                        'position' => $request->position,
                    ]);
                }
                // }
                Alert::toast("Data Successfully Updated", 'success');
                return back();
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function update_image_profile(Request $request)
    {
        try {
            // dd($request->all());
            $id = Auth::user()->id;
            $user_name = Auth::user()->name;
            $validator = Validator::make($request->all(), [
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if (!$validator->fails()) {
                $user = User::findOrFail($id);

                $image = $request->file('photo');
                $image_name = time() . '-user-' . $user_name . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/uploads/user/', $image, $image_name);
                $user->update([
                    'image' => $image_name
                ]);
                Alert::toast('Profile User Successfully Changed', 'success');
                return back();
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function change_password(Request $request)
    {
        try {
            // dd($request->all());
            $id = Auth::user()->id;
            $validator = Validator::make($request->all(), [
                'passNew' => 'required|min:8',
                'passOld' => 'required'
            ]);
            if (!$validator->fails()) {
                if (!(Hash::check($request->passOld, Auth::user()->password))) {
                    Alert::toast('old password does not match', 'error');
                    return back()->withInput();
                }
                $user = User::findOrFail($id);
                $user->update([
                    'password' => Hash::make($request->passNew)
                ]);
                Alert::toast('Reset Password Successfully', 'success');
                return back()->withInput();
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
}
