<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        try {
            $active = 'pesanan';
            $id = Auth::user()->id;
            $tgl = Carbon::now();
            $day = bin2hex($tgl->toDateTimeString());

            // if (Auth::user()->roles == 'kantin') {
            $order = Orders::with('product', 'order_detail.product_laporan_and_pesanan', 'user', 'order_status_pesanan_and_laporan')
                ->where('id_order_status', 4)
                // ->whereDate('date_order', $tgl)
                ->get();

            // dd($order);
            if (empty($order[0])) {
                return response()->json([
                    'meta' => [
                        'status' => 'Error',
                        'message' => 'Data Not Found'
                    ],
                ], 200);
            }

            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Successfully fetch data'
                ],
                'data' => [
                    'order' => $order,
                ]
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }
}
