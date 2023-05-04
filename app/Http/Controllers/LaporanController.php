<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Outlet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $active = 'laporan';
            $id = Auth::user()->id;
            $tgl = Carbon::now();
            $day = bin2hex($tgl->toDateTimeString());
            // $day = Carbon::createFromFormat('d/m/Y',  $tgl1);
            // dd($tgl1);

            if (Auth::user()->roles == 'kantin') {
                // omzet_today, omzet total, nam product, tanggal, jumlah,
                $order = DB::table('outlets')
                    ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                    ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                    ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->join('products as p', 'p.name', '=', 'od.product')
                    ->where('outlets.id_user', $id)
                    ->whereDay('o.date_order', $tgl)
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

                return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order', 'day', 'id'));
            } else if (Auth::user()->roles == 'admin') {
                //
                $order = DB::table('outlets')
                    ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                    ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                    ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->join('products as p', 'p.name', '=', 'od.product')
                    // ->where('outlets.id_user', $id)
                    ->whereDay('o.date_order', $tgl)
                    ->where('os.name', 'sukses')
                    // ->groupBy('o.id_outlet')
                    ->get();
                // $cona = Orders::all();
                // dd($order);
                $kantin = DB::table('outlets')
                    ->select('name', 'id_user')
                    ->where('id_user', '!=', Auth::user()->id)
                    ->get();
                // dd($kantin);

                $order2 = DB::table('outlets')
                    ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                    ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                    ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->join('products as p', 'p.name', '=', 'od.product')
                    // ->where('outlets.id_user', $id)
                    // ->whereDay('o.date_order', $tgl)
                    ->where('os.name', 'sukses')
                    // ->groupBy('o.id_outlet')
                    ->get();


                $today_omzet = array();
                $today_order = array();
                // $data = $order->where('date_order', $date);
                foreach ($order2 as $item) {
                    $all = $item->total;
                    // dd($all);
                    array_push($today_omzet, $all);
                }
                foreach ($order2 as $item) {
                    $all = $item->id;
                    // dd($all);
                    array_push($today_order, $all);
                }
                $omzet_today = array_sum($today_omzet);
                $order_today = count($today_order);

                return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order', 'day', 'kantin', 'id'));
            }
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function index_admin($id)
    {
        try {
            $active = 'laporan';
            $tgl = Carbon::now();
            $day = bin2hex($tgl->toDateTimeString());
            $order = DB::table('outlets')
                ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->where('outlets.id_user', $id)
                ->whereDay('o.date_order', $tgl)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();

            $kantin = DB::table('outlets')
                ->select('name', 'id_user')
                ->where('id_user', '!=', Auth::user()->id)
                ->get();
            // dd($kantin);

            $order2 = DB::table('outlets')
                ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                // ->where('outlets.id_user', $id)
                // ->whereDay('o.date_order', $tgl)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();


            $today_omzet = array();
            $today_order = array();
            // $data = $order->where('date_order', $date);
            foreach ($order2 as $item) {
                $all = $item->total;
                // dd($all);
                array_push($today_omzet, $all);
            }
            foreach ($order2 as $item) {
                $all = $item->id;
                // dd($all);
                array_push($today_order, $all);
            }
            $omzet_today = array_sum($today_omzet);
            $order_today = count($today_order);

            return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order', 'day', 'kantin', 'id'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function filter_date(Request $request)
    {
        try {
            $id = $request->id_user;
            if ($request->id == Auth::user()->id) {
                $id = Auth::user()->id;
            } else {
                $id = $request->id_user;
            }

            // dd($id);
            $active = 'laporan';
            // $id = Auth::user()->id;
            $date_filter = Carbon::parse($request->date('date'))->format('d/m/Y');
            $date = Carbon::createFromFormat('d/m/Y',  $date_filter);
            // dd($request->all(), $date);
            $day = bin2hex($date->toDateTimeString());
            // dd($request->date);


            // omzet_today, omzet total, nam product, tanggal, jumlah,
            $order = DB::table('outlets')
                ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->where('outlets.id_user', $id)
                ->whereMonth('o.date_order', '=', $date)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();

            $kantin = DB::table('outlets')
                ->select('name', 'id_user')
                ->where('id_user', '!=', Auth::user()->id)
                ->get();
            // $cona = Orders::all();
            // dd($order);
            $order2 = DB::table('outlets')
                ->select('o.total', 'p.name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                // ->where('outlets.id_user', $id)
                // ->whereDay('o.date_order', $tgl)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();


            $today_omzet = array();
            $today_order = array();
            // $data = $order->where('date_order', $date);
            foreach ($order2 as $item) {
                $all = $item->total;
                // dd($all);
                array_push($today_omzet, $all);
            }
            foreach ($order2 as $item) {
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

            return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order', 'day', 'kantin', 'id'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function print($date, $id)
    {
        try {
            //code...
            // dd(urldecode($date));
            $date_2 = hex2bin($date);
            $date_filter = Carbon::parse($date_2)->format('d/m/Y');
            $date_3 = Carbon::createFromFormat('d/m/Y',  $date_filter);
            // dd($deee);

            // $id = Auth::user()->id;
            $order = DB::table('outlets')
                ->select('o.total', 'p.name as product_name', 'o.date_order', 'od.quantity', 'o.proof_of_payment', 'o.id', 'outlets.name')
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id', '=', 'o.id_order_detail')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->where('outlets.id_user', $id)
                ->whereMonth('o.date_order', '=', $date_3)
                ->where('os.name', 'sukses')
                // ->groupBy('o.id_outlet')
                ->get();
            // dd($order, $date_2);
            // $pdf = PDF::loadView('tenant.page.print', compact('order'));

            // return $pdf->stream();
            $pdf = PDF::loadView('tenant.page.print', [
                'order' => $order
            ])->setpaper('a4', 'potrait');
            return view('tenant.page.print', compact('order'));
            return $pdf->download('slip-gaji' . '-' . $order[0]->name . '.pdf');
        } catch (Exception $error) {
            dd($error->getMessage());
        }

        // return $pdf->stream();
    }
}
// $date = Carbon::createFromFormat('d/m/Y',  '19/04/2000');
