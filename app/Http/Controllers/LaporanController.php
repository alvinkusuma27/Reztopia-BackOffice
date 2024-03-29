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
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $active = 'laporan';
            $id = Auth::user()->id;
            $tgl = Carbon::now();
            $day = bin2hex($tgl->toDateTimeString());

            if (Auth::user()->roles == 'kantin') {
                $order = Orders::with(
                    'product',
                    'order_detail.product_laporan_and_pesanan',
                    'user',
                    'order_status_pesanan_and_laporan',
                    'outlet'
                )
                    ->where('id_order_status', 1)
                    ->whereHas('outlet', function ($query) {
                        $query->where('id_user', Auth::user()->id);
                    })
                    ->get();
                $today_omzet = array();
                $today_order = array();
                foreach ($order as $item) {
                    $all = $item->total;
                    array_push($today_omzet, $all);
                }
                foreach ($order as $item) {
                    $all = $item->id;
                    array_push($today_order, $all);
                }
                $omzet_today = array_sum($today_omzet);
                $order_today = count($today_order);


                return view('tenant.page.laporan', compact('active', 'order_today', 'omzet_today', 'order', 'day', 'id'));
            } else if (Auth::user()->roles == 'admin') {
                $order = Orders::with(
                    'product',
                    'order_detail.product_laporan_and_pesanan',
                    'user',
                    'order_status_pesanan_and_laporan'
                )
                    ->where('id_order_status', 1)
                    // ->whereDate('date_order', $tgl)
                    ->get();
                // $cona = Orders::all();
                $kantin = DB::table('outlets')
                    ->select('name', 'id_user')
                    ->where('id_user', '!=', Auth::user()->id)
                    ->get();

                $order2 = DB::table('outlets')
                    ->select(
                        'o.total',
                        'p.name',
                        'o.date_order',
                        'od.quantity',
                        'o.proof_of_payment',
                        'o.id'
                    )
                    ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                    ->join('order_details as od', 'od.id_order', '=', 'o.id')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->join('products as p', 'p.id', '=', 'od.id_product')
                    ->where('os.name', 'sukses')
                    ->get();


                $today_omzet = array();
                $today_order = array();
                foreach ($order2 as $item) {
                    $all = $item->total;
                    array_push($today_omzet, $all);
                }
                foreach ($order2 as $item) {
                    $all = $item->id;
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
                ->select(
                    'o.total',
                    'p.name',
                    'o.date_order',
                    'od.quantity',
                    'o.proof_of_payment',
                    'o.id',
                    'o.table_number as table_number_order',
                    'o.payment_method as payment_method_order',
                    'o.total as total_order',
                    'p.original_price as price_product',
                    // 'c.type_order',
                    'u.name as name_user',
                    'od.id as id_order_detail'
                )
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id_order', '=', 'o.id')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.id', '=', 'od.id_product')
                ->join('users as u', 'u.id', '=', 'o.id_user')
                // ->join('cart as c', 'c.id_product', '=', 'p.id')
                ->where('outlets.id_user', $id)
                // ->whereDate('o.date_order', $tgl)
                ->where('os.name', 'sukses')
                ->groupBy('od.id')
                ->get();

            $kantin = DB::table('outlets')
                ->select('name', 'id_user')
                ->where('id_user', '!=', Auth::user()->id)
                ->get();
            // dd($kantin);

            $order2 = DB::table('outlets')
                ->select(
                    'o.total',
                    'p.name',
                    'o.date_order',
                    'od.quantity',
                    'o.proof_of_payment',
                    'o.id',
                    'o.table_number as table_number_order',
                    'o.payment_method as payment_method_order',
                    'o.total as total_order',
                    'p.original_price as price_product',
                    // 'c.type_order',
                    'u.name as name_user'
                )
                ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                ->join('order_details as od', 'od.id_order', '=', 'o.id')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('products as p', 'p.id', '=', 'od.id_product')
                ->join('users as u', 'u.id', '=', 'o.id_user')
                // ->join('cart as c', 'c.id_product', '=', 'p.id')
                // ->where('outlets.id_user', $id)
                // ->whereDate('o.date_order', $tgl)
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
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'date_from' => 'required',
                'date_to' => 'required'
            ]);
            if (!$validator->fails()) {
                $id = $request->id_user;

                $date_from = date($request->date_from);
                $date_to = date($request->date_to);
                $day = bin2hex($date_from);
                if ($id == Auth::user()->id) {
                    $order = DB::table('outlets')
                        ->select(
                            'o.total',
                            'p.name',
                            'o.date_order',
                            'od.quantity',
                            'o.proof_of_payment',
                            'o.id',
                            'o.table_number as table_number_order',
                            'o.payment_method as payment_method_order',
                            'o.total as total_order',
                            'p.original_price as price_product',
                            'p.price_final',
                            // 'c.type_order',
                            'u.name as name_user',
                            'od.id as id_order_detail'
                        )
                        ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                        ->join('order_details as od', 'od.id_order', '=', 'o.id')
                        ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                        ->join('products as p', 'p.id', '=', 'od.id_product')
                        ->join('users as u', 'u.id', '=', 'o.id_user')
                        ->whereBetween('o.date_order', [$date_from, $date_to])
                        ->where('os.name', 'sukses')
                        ->groupBy('od.id')
                        ->get();
                } else {
                    $order = DB::table('outlets')
                        ->select(
                            'o.total',
                            'p.name',
                            'o.date_order',
                            'od.quantity',
                            'o.proof_of_payment',
                            'o.id',
                            'o.table_number as table_number_order',
                            'o.payment_method as payment_method_order',
                            'o.total as total_order',
                            'p.original_price as price_product',
                            'p.price_final',
                            // 'c.type_order',
                            'u.name as name_user',
                            'od.id as id_order_detail'
                        )
                        ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                        ->join('order_details as od', 'od.id_order', '=', 'o.id')
                        ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                        ->join('products as p', 'p.id', '=', 'od.id_product')
                        ->join('users as u', 'u.id', '=', 'o.id_user')
                        // ->join('cart as c', 'c.id_product', '=', 'p.id')
                        // ->whereDate('o.date_order', $date)
                        ->whereBetween('o.date_order', [$date_from, $date_to])
                        ->where('outlets.id_user', $id)
                        ->where('os.name', 'sukses')
                        ->groupBy('od.id')
                        ->get();
                    // dd($request->id_user, $order);
                }

                // dd($id, $request->all());
                $active = 'laporan';
                // $id = Auth::user()->id;
                $date_filter = Carbon::parse($request->date('date'))->format('d/m/Y');
                $date = Carbon::createFromFormat('d/m/Y',  $date_filter);
                // dd($request->all(), $date);
                $day = bin2hex($date->toDateTimeString());

                $kantin = DB::table('outlets')
                    ->select('name', 'id_user')
                    ->where('id_user', '!=', Auth::user()->id)
                    ->get();
                // $cona = Orders::all();
                // dd($order);
                $order2 = DB::table('outlets')
                    ->select(
                        'o.total',
                        'p.name',
                        'o.date_order',
                        'od.quantity',
                        'o.proof_of_payment',
                        'o.id',
                        'o.table_number as table_number_order',
                        'o.payment_method as payment_method_order',
                        'o.total as total_order',
                        'p.original_price as price_product',
                        'c.type_order',
                        'u.name as name_user'
                    )
                    ->join('orders as o', 'o.id_outlet', '=', 'outlets.id')
                    ->join('order_details as od', 'od.id_order', '=', 'o.id')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->join('products as p', 'p.id', '=', 'od.id_product')
                    ->join('users as u', 'u.id', '=', 'o.id_user')
                    ->join('cart as c', 'c.id_product', '=', 'p.id')

                    ->where('os.name', 'sukses')
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

                return view('tenant.page.laporan', compact('active', 'order_today', 'date_from', 'date_to', 'omzet_today', 'order', 'day', 'kantin', 'id'));
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function print($date, $id)
    {
        try {
            $date_2 = hex2bin($date);
            $date_filter = Carbon::parse($date_2)->format('d/m/Y');
            $date_3 = Carbon::createFromFormat('d/m/Y',  $date_filter);

            $id = Auth::user()->id;
            $order = Orders::with(

                [
                    'outlet' => function ($query) {
                        $query->where('id_user',  Auth::user()->id);
                    }, 'product',
                    'order_detail.product_laporan_and_pesanan',
                    'user',
                    'order_status_pesanan_and_laporan',
                ]
            )
                ->where('id_order_status', 1)
                ->whereDate('date_order', $date_3)
                ->get();
            $total = array();
            foreach ($order as $item) {
                array_push($total, $item->total);
            }
            $total = array_sum($total);
            $pdf = PDF::loadView('tenant.page.print', [
                'order' => $order,
                'total' => $total
            ])->setpaper('a4', 'potrait');
            return view('tenant.page.print', compact('order', 'total'));
            return $pdf->download('slip-gaji' . '-' . $order[0]->name . '.pdf');
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function pesanan()
    {
        try {
            $active = 'pesanan';
            $id = Auth::user()->id;
            $tgl = Carbon::now();
            $day = bin2hex($tgl->toDateTimeString());

            $order = Orders::with('product', 'outlet', 'order_detail.product_laporan_and_pesanan', 'user', 'order_status_pesanan_and_laporan')
                ->where(function ($query) {
                    $query->where('id_order_status', 4)
                        ->orWhere('id_order_status', 1);
                })
                ->whereHas('outlet', function ($query) {
                    $query->where('id_user', Auth::user()->id);
                })
                ->whereDate('date_order', $tgl)
                ->where('payment_status', 'SUCCESS')
                ->get();
            // dd($order);
            $checkLastOrder = Orders::latest()->first()->date_order;
            $checkDate = Carbon::now()->toDateString();

            $count_id = $order->count('id');


            Orders::where('date_order', '<', Carbon::now()->toDateString())->update([
                'id_order_status' => 2
            ]);

            return view('tenant.page.daftarPesanan', compact('active', 'order', 'day', 'id', 'count_id', 'checkLastOrder', 'checkDate'));
            // return view('tenant.page.pos', compact('active', 'order', 'day', 'id', 'count_id', 'checkLastOrder', 'checkDate'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function accept_order(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::toast($validator->messages()->all(), 'error');
                return redirect()->route('pesanan');
            }
            $order = Orders::findOrFail($request->id);
            $order->update([
                'id_order_status' => 1,
            ]);

            $id_order = $order->id;
            DB::table('orders')->where('id', $id_order)
                ->update(['is_hidden' => 1]);

            if ($order->update()) {
                Alert::toast('Order Successfully Accepted', 'success');
                return redirect()->route('pesanan');
            } else {
                Alert::toast('Something went wrong', 'error');
                return redirect()->route('pesanan');
            }
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function history()
    {
        $active = 'pesanan';
        $id = Auth::user()->id;
        $tgl = Carbon::now();
        $day = bin2hex($tgl->toDateTimeString());

        $order = Orders::with('product', 'order_detail.product_laporan_and_pesanan', 'user', 'order_status_pesanan_and_laporan')
            ->where('id_order_status', 1)
            ->where('payment_status', 'SUCCESS')
            ->whereDate('date_order', $tgl)
            ->get();
        // dd($order);
        return view('tenant.page.history', compact('active', 'order', 'day', 'id'));
    }
}
