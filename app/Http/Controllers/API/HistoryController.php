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
                ->select(
                    'or.id as id_order',
                    'od.id as id_order_detail',
                    'or.link',
                    'ot.image as image_tenant',
                    'or.date_order',
                    'ot.name',
                    'od.quantity',
                    'or.total as total_order',
                    'p.original_price as price_product',
                    'os.name as status',
                    'or.payment_status',
                    'or.payment_url'
                )
                ->join('outlets as ot', 'ot.id', '=', 'or.id_outlet')
                ->join('order_status as os', 'os.id', '=', 'or.id_order_status')
                ->join('order_details as od', 'od.id_order', '=', 'or.id')
                ->join('products as p', 'p.id', '=', 'od.id_product')
                ->where('or.id_user', Auth::user()->id)
                ->whereIn('os.id', [1, 4])
                ->groupBy('or.id')
                ->get();
            // dd($data);

            if (!empty($data[0])) {
                $result = array();
                foreach ($data as $item) {
                    $item->image_tenant = env('APP_URL') . '/storage/uploads/outlet/' . $item->image_tenant;
                    $item->link = route('history.detail', $item->id_order_detail);
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
                    'p.original_price as price_product',
                    'os.name as status_order',
                    'or.date_order',
                    'od.quantity as quantity_order',
                    'or.payment_code as payment_code_order',
                    'u.name as name_user_order',
                    'or.table_number as table_number_order',
                    'ot.name as tenant_name_order',
                    'or.payment_method as payment_method_order',
                    'or.total as total_order',
                    'or.payment_url'
                )
                ->join('outlets as ot', 'ot.id', '=', 'or.id_outlet')
                ->join('order_status as os', 'os.id', '=', 'or.id_order_status')
                ->join('order_details as od', 'od.id_order', '=', 'or.id')
                ->join('products as p', 'p.id', '=', 'od.id_product')
                ->join('users as u', 'u.id', '=', 'or.id_user')
                ->where('or.id_user', Auth::user()->id)
                ->whereIn('os.id', [1, 4])
                ->where('or.id', $id)
                ->get();

            $data2 = DB::table('orders as or')
                ->select(
                    'ot.id as id_outlet',
                    'p.name as product_name',
                    'p.image as image_product',
                    // 'od.price as price_total_product',
                    'p.original_price as price_product',
                    'os.name as status_order',
                    'or.date_order',
                    'od.quantity as quantity_order',
                    'or.payment_code as payment_code_order',
                    'u.name as name_user_order',
                    'or.table_number as table_number_order',
                    'ot.name as tenant_name_order',
                    'or.payment_method as payment_method_order',
                    'or.total as total_order',
                    'or.order_type',
                    'or.payment_status',
                    'or.id',
                    'or.id_user'
                )
                ->join('outlets as ot', 'ot.id', '=', 'or.id_outlet')
                ->join('order_status as os', 'os.id', '=', 'or.id_order_status')
                ->join('order_details as od', 'od.id_order', '=', 'or.id')
                ->join('products as p', 'p.id', '=', 'od.id_product')
                ->join('users as u', 'u.id', '=', 'or.id_user')
                ->where('or.id_user', Auth::user()->id)
                ->whereIn('os.id', [1, 4])
                ->where('or.id', $id)
                ->get();

            if (!empty($data[0])) {
                $result_product = array();
                $result_history = array();

                // dd($data);
                foreach ($data as $item) {
                    // dd($item->id);
                    unset($item->status_order);
                    // unset($item->quantity_order);
                    unset($item->payment_code_order);
                    unset($item->name_user_order);
                    unset($item->table_number_order);
                    unset($item->tenant_name_order);
                    unset($item->id);
                    unset($item->id_outlet);
                    unset($item->price_total_product);
                    unset($item->date_order);
                    unset($item->payment_method_order);
                    unset($item->total_order);

                    // unset($item->id);
                    $item->image_product = env('APP_URL') . '/storage/uploads/products/' . $item->image_product;
                    array_push($result_product, $item);
                }

                foreach ($data2 as $item) {

                    unset($item->product_name);
                    unset($item->image_product);
                    unset($item->price_product);
                    // unset($item->status_order);
                    unset($item->product_name);
                    unset($item->id_outlet);
                    unset($item->quantity_order);

                    array_push($result_history, $item);
                    break;
                }


                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ], 'data' => [
                        'product' => $result_product,
                        'history' => $result_history
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
