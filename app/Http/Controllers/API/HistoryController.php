<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Products;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {

        try {
            $data = DB::table('orders as or')
                ->select('or.link', 'or.id', 'ot.image as image_tenant', 'or.date_order', 'ot.name', 'od.quantity', 'od.price as price_total', 'p.original_price as price_product', 'os.name as status')
                ->join('outlets as ot', 'ot.id', '=', 'or.id_outlet')
                ->join('order_status as os', 'os.id', '=', 'or.id_order_status')
                ->join('order_details as od', 'od.id', '=', 'or.id_order_detail')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->where('or.id_user', Auth::user()->id)
                ->get();
            if (!empty($data[0])) {
                $result = array();
                foreach ($data as $item) {
                    $item->image_tenant = env('APP_URL') . '/storage/uploads/tenant/' . $item->image_tenant;
                    $item->link = env('APP_URL') . route('history.detail', $item->id);
                    array_push($result, $item);
                }
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'Failed',
                        'message' => 'Data not found',
                    ]
                ], 404);
            }

            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Successfully fetch data'
                ], 'data' => $result
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }

    public function history_detail($id)
    {
        try {
            // $data_history = array();
            $data = DB::table('orders as or')
                ->select(
                    'ot.id as id_outlet',
                    'p.name as product_name',
                    'p.image as image_product',
                    'od.price as price_total_product',
                    'p.original_price as price_product',
                    'os.name as status_order',
                    'or.date_order',
                    'od.quantity as quantity_order',
                    'or.payment_code as payment_code_order',
                    'u.name as name_user_order',
                    'or.table_number as table_number_order',
                    'ot.name as tenant_name_order',
                    'or.payment_method as payment_method_order',
                    'od.price as total_order'
                )
                ->join('outlets as ot', 'ot.id', '=', 'or.id_outlet')
                ->join('order_status as os', 'os.id', '=', 'or.id_order_status')
                ->join('order_details as od', 'od.id', '=', 'or.id_order_detail')
                ->join('products as p', 'p.name', '=', 'od.product')
                ->join('users as u', 'u.id', '=', 'or.id_user')
                ->where('or.id_user', Auth::user()->id)
                ->where('or.id', $id)
                ->get();
            // array_push($data_history, $data);
            define('data_history', $data);
            $data_history = data_history;
            // dd($data, $data_history);
            // $data = Orders::join('outlets as ot', 'ot.id', '=', 'orders.id_outlet')
            //     ->join('order_status as os', 'os.id', '=', 'orders.id_order_status')
            //     ->join('order_details as od', 'od.id_order', '=', 'orders.id')
            //     ->join('products as p', 'p.id', '=', 'od.id_product')
            //     ->where('orders.id_user', Auth::user()->id)
            //     ->where('orders.id', $id)
            //     ->get();
            // $coba = Orders::with('outlet', 'order_status', 'order_detail')->where('id_user', 3)->get();

            // BELUM SELESAI
            // $data_history = $data;
            // echo data_history;
            // dd($data_history);
            if (!empty($data[0])) {
                $result_product = array();
                // $result_history = array();

                // dd($data);
                foreach ($data as $item) {
                    // dd($item->id);
                    // unset($item->status_order);
                    // unset($item->quantity_order);
                    // unset($item->payment_code_order);
                    // unset($item->name_user_order);
                    // unset($item->table_number_order);
                    // unset($item->tenant_name_order);
                    // unset($item->id);
                    // unset($item->id);
                    // unset($item->id);
                    $item->image_product = env('APP_URL') . '/storage/uploads/history-detail/' . $item->image_product;
                    array_push($result_product, $item);
                }
                // dd(
                //     $data,
                //     $data_history,
                //     $result_history
                // );

                // foreach ($data_history as $item) {
                //     // set()

                //     unset($item->product_name);
                //     unset($item->image_product);
                //     unset($item->price_product);
                //     // unset($item->status_order);
                //     unset($item->product_name);
                //     array_push($result_history, $item);
                //     break;
                // }


                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ], 'data' => [
                        'product' => $result_product,
                        // 'history' => $result_history
                    ]
                ], 200);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'Failed',
                        'message' => 'Data not found',
                    ]
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }
}
