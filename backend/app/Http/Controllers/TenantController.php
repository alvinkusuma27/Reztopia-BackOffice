<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Outlet;
use App\Models\User;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function index()
    {
        try {
            $active = 'tenant';
            // $user = User::select('id')->latest()->get();
            // dd($user);
            // $id = Auth::user()->id;
            // id, nama, tenant
            $outlet = Outlet::with('user')->where('id_user', '!=', '1')->get();
            // dd($outlet);
            return view('tenant.page.tenant', compact('active', 'outlet'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'tenant' => 'required',
                'password' => 'required|min:8',
                'phone' => 'required',
                'email' => 'required|unique:users',
            ]);

            if (!$validator->fails()) {
                $user = new User();
                $user->name = $request->name;
                $user->password = Hash::make($request->password);
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->roles = 'kantin';
                // dd($user->save());
                $user->save();

                $outlet = new Outlet();
                $outlet->name = $request->tenant;
                $outlet->created_by = Auth::user()->name;
                $outlet->id_user = $user->id;
                $outlet->phone = $request->phone;
                $outlet->save();


                Alert::toast('Success Created Account', 'success');
                return back();
            }
            // dd($validator->errors());
            Alert::toast($validator->errors()->all(), 'error');
            return back()->withInput();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
        // dd($request->all());


    }

    public function update($id, Request $request)
    {
        try {
            // dd($request->all(), $id);
            if ($request->password) {
                $validator = Validator::make($request->all(), [
                    'password' => 'min:8',
                ]);

                if (!$validator->fails()) {
                    $outlet = Outlet::findOrFail($id);
                    if ($request->name) {
                        $outlet->update([
                            'name' => $request->name
                        ]);
                    }

                    // name,email,phone, password
                    $user = User::findOrFail($outlet->id_user);
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->password)
                    ]);

                    $outlet->update([
                        'phone' => $request->phone
                    ]);
                } else {
                    Alert::toast($validator->messages()->all(), 'error');
                    return back();
                }
                Alert::toast('Success Update Account', 'success');
                return back();
            }
            $outlet = Outlet::findOrFail($id);
            if ($request->name) {
                $outlet->update([
                    'name' => $request->name
                ]);
            }

            // name,email,phone, password
            $user = User::findOrFail($outlet->id_user);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            $outlet->update([
                'phone' => $request->phone
            ]);
            Alert::toast('Success Update Account', 'success');
            return back();
            // dd($validator->messages()->all());
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $outlet = Outlet::findOrFail($id);
            $user = User::findOrFail($outlet->id_user);
            $outlet->delete();
            $user->delete();
            // dd($outlet->delete(), $user->delete());
            Alert::toast('Success Delete Account', 'success');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function tenantControl()
    {
        // dd($id);
        try {
            $active = 'tenant-control';
            // $user = User::select('id')->latest()->get();
            // dd($user);
            // $id = Auth::user()->id;
            // id, nama, tenant
            $outlet = Outlet::with('user')->where('id_user', '!=', '1')->get();
            // dd($outlet);
            return view('tenant.page.tenant-control', compact('active', 'outlet'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function changeActiveTenant($id)
    {
        try {
            // dd($id);
            $tenant = Outlet::findOrFail($id);
            // dd($tenant);
            if ($tenant->active == 'active') {

                $tenant->update([
                    'active' => 'deactive'
                ]);
                Alert::success('Succes Deactive');
                return back();
            } else {
                $tenant->update([
                    'active' => 'active'
                ]);
                Alert::success('Succes Activated');
                return back();
            }
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
}
