<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $id = Auth::user()->id;
        $tgl = Carbon::now();
        // $date = $tgl->toDateString();
        $date = "2023-04-16";


        // omzet_today, omzet total, nam product, tanggal, jumlah,
        $order = DB::table('outlets')
            ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
            ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
            ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
            ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
            ->join('products as p', 'p.name', '=', 'od.product')
            ->where('outlets.id_user', $id)
            // ->groupBy('o.id_outlet')
            ->get();
        $cona = Orders::all();
        // dd($order);
        $today = array();
        $total = array();
        $data = $order->where('date_order', $date);
        foreach ($data as $item) {
            $all = $item->total;
            array_push($today, $all);
        }
        foreach ($order as $item) {
            $all = $item->total;
            array_push($total, $all);
        }
        $omzet_today = array_sum($today);
        $omzet_total = array_sum($total);
        // dd($omzet_total);

        // $omzet_today =
        // $omzet_total

        return view('tenant.page.laporan', compact('active', 'omzet_total', 'omzet_today', 'order'));
    }
}
