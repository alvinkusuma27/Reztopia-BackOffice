<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Outlet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $active = 'laporan';
            $id = Auth::user()->id;
            $tgl = Carbon::now();
            $date = $tgl->day;


            // omzet_today, omzet total, nam product, tanggal, jumlah,
            $order = DB::table('outlets')
                ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->where('outlets.id_user', $id)
                ->whereDay('o.date_order', $date)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();
            // $cona = Orders::all();
            // dd($order);
            $today_omzet = array();
            $today_order = array();
            // $data = $order->where('date_order', $date);
            foreach ($order as $item) {
                $all = $item->total;
                // dd($all);
                array_push($today_omzet, $all);
            }
            foreach ($order as $item) {
                $all = $item->id;
                // dd($all);
                array_push($today_order, $all);
            }
            $omzet_today = array_sum($today_omzet);
            $order_today = count($today_order);
            // dd($omzet_today, $omzet_total);
            // dd($omzet_total);

            // $omzet_today =
            // $omzet_total

            return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
}
