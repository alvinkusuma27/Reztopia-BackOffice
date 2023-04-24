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
        $date = $tgl->month;
        $id = Auth::user()->id;

        $outlet = Outlet::with('user')->where('id_user', $id)->get();

        $data = DB::table('orders')
            ->join('outlets', 'outlets.id', '=', 'orders.id_outlet')
            ->where('outlets.id_user', $id)
            // ->where('MONTH(orders.date_order)', $date)
            ->whereMonth('orders.date_order', $date)
            // ->groupBy('orders.date_order')
            // ->orderBy('orders.date_order', 'asc')
            ->get();
        // dd($data);

        $total_order = $data->sum('total');
        $today_order = $data->count('id');
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


        return view('tenant.page.dashboard', compact('active', 'today_order', 'total_order', 'top_product', 'outlet', 'total_product'));
    }
}

// outlet
// categories
// product
// order_status
// order
// order_detail
