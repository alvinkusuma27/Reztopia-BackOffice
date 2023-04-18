<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Outlet;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $active = 'dashboard';
        $tgl = Carbon::now();
        $date = $tgl->toDateString();
        $id = Auth::user()->id;

        $outlet = Outlet::with('user')->where('id_user', $id)->get();

        $data = DB::table('orders')
            ->join('outlets', 'outlets.id', '=', 'orders.id_outlet')
            ->where('id_user', $id)
            ->get();

        $total_order = $data->sum('id');
        $today_order = $data->where('date_order', $date)->sum('id');
        // dd($outlet);
        //         SELECT * FROM products
        // JOIN categories ON products.id_category = categories.id
        // JOIN outlets ON outlets.id = categories.id_outlet
        // JOIN users ON users.id = outlets.id_user

        $data_product = DB::table('products')
            ->join('categories as c', 'c.id', '=', 'products.id_category')
            ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
            ->join('orders as or', 'o.id', '=', 'or.id_outlet')
            ->get();
        // dd($data);
        // $order = Orders::with('categories')->get();
        $top_product = DB::table('orders')
            ->select('p.name', 'p.price', DB::raw('count(p.id) as total'))
            ->join('categories as c', 'c.id', '=', 'orders.id_categories')
            ->join('products as p', 'p.id_category', '=', 'c.id')
            ->join('outlets as o', 'o.id', '=', 'orders.id_outlet')
            ->orderBy('p.id')
            ->groupBy('p.name')
            ->where('o.id_user', $id)
            ->get();
        // $categ = Categories::all();
        // dd($top_product);


        return view('tenant.page.dashboard', compact('active', 'today_order', 'total_order', 'top_product', 'outlet'));
    }
}

// outlet
// categories
// product
// order_status
// order
// order_detail
