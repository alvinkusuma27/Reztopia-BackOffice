<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Outlet;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     // dd(Auth::user());
    //     // $active = Outlet::where('id_user', Auth::user()->id)->select('active')->get();
    //     // if ($active[0]->active != "active") {
    //     //     Session::flash('your tenant is deactived', 'contact admin to activate the outlet');
    //     //     return redirect()->route('login');
    //     // }
    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::user();

    //         // return $next($request);
    //         if($)
    //     });
    //     // dd(Auth::user());
    // }


    public function index()
    {
        $active_tenant = Outlet::where('id_user', Auth::user()->id)->select('active')->get();
        if ($active_tenant[0]->active != 'active') {
            Auth::logout();
            Alert::error('Tenant is Deactived', 'Please Contact the Admin to Activate the Tenant');
            return redirect()->route('login');
        }

        $active = 'dashboard';
        $tgl = Carbon::now();
        $date = $tgl->month;
        $id = Auth::user()->id;
        // dd($id);

        // $outlet = Outlet::with('user')->where('id_user', $id)->get();
        $outlet = DB::table('outlets as o')
            ->select('o.name as tenant_name', 'c.id as id_category', 'p.name as name_product')
            ->join('categories as c', 'c.id_outlet', 'o.id')
            ->join('products as p', 'p.id_category', '=', 'c.id')
            ->where('o.id_user', $id)
            ->get();

        $data = DB::table('orders')
            ->join('outlets', 'outlets.id', '=', 'orders.id_outlet')
            ->join('categories as c', 'c.id_outlet', '=', 'outlets.id')
            ->where('outlets.id_user', $id)
            // ->where('MONTH(orders.date_order)', $date)
            ->whereMonth('orders.date_order', $date)
            ->groupBy('orders.id')
            // ->groupBy('orders.date_order')
            // ->orderBy('orders.date_order', 'asc')
            ->get();
        // CATEGORY, MENU
        // dd($data);


        $total_order = $data->sum('total');
        $today_order = $data->count('id');
        $total_category = $outlet->unique('id_category')->count();
        $total_menu = $outlet->unique('name_product')->count();
        $tenant_name = $outlet[0]->tenant_name;
        // dd($outlet);
        //         SELECT * FROM products
        // JOIN categories ON products.id_category = categories.id
        // JOIN outlets ON outlets.id = categories.id_outlet
        // JOIN users ON users.id = outlets.id_user

        $data_product = DB::table('products')
            ->join('categories as c', 'c.id', '=', 'products.id_category')
            ->join('orders as or', 'or.id_category', '=', 'c.id')
            ->join('outlets as o', 'o.id', '=', 'or.id_outlet')
            ->get();
        // dd($data);
        // $order = Orders::with('categories')->get();
        $top_product = DB::table('orders')
            ->select('p.name', 'p.original_price', 'od.quantity as total')
            // ->select('p.name', 'p.original_price', 'od.quantity as total')
            // ->distinct('total')
            ->join('categories as c', 'c.id', '=', 'orders.id_category')
            ->join('outlets as o', 'o.id', '=', 'orders.id_outlet')
            ->join('order_details as od', 'od.id', '=', 'orders.id_order_detail')
            ->join('products as p', 'p.name', '=', 'od.product')
            ->orderBy('total')
            ->groupBy('p.name')
            // ->groupBy('od.id_product')
            // ->groupBy('total')
            ->where('o.id_user', $id)
            // ->where('od.id_product', 1)
            ->get();

        $total_product = DB::table('orders')
            ->select('od.quantity as total')
            // ->select(DB::raw('distinct(od.quantity) as total'))
            ->join('categories as c', 'c.id', '=', 'orders.id_category')
            // ->join('products as p', 'p.id_category', '=', 'c.id')
            ->join('outlets as o', 'o.id', '=', 'orders.id_outlet')
            ->join('order_details as od', 'od.id', '=', 'orders.id_order_detail')
            ->join('products as p', 'p.name', '=', 'od.product')
            // ->orderBy('p.id')
            // ->groupBy('p.name')
            ->groupBy('total')
            ->where('o.id_user', $id)
            ->get();
        // dd($total_product);
        // $categ = Categories::all();
        // dd($top_product);


        return view('tenant.page.dashboard', compact('active', 'today_order', 'total_order', 'top_product', 'outlet', 'total_product', 'total_category', 'total_menu', 'tenant_name'));
    }
}

// outlet
// categories
// product
// order_status
// order
// order_detail
